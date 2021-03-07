<?php

namespace app\controllers;

use Yii;
use app\models\Posts;
use app\models\Sklat;
use app\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpExceptio if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        
        $model_sklat = new Sklat();

        $kirim = Yii::$app->request->post('Posts');

        $kirim_date = $kirim['sana'];

        $nomi = $kirim['nomi'];

        $command = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$nomi' AND `sana` LIKE '$kirim_date'");
        
        $result = $command->queryOne();


        if( $result['sana'] == $kirim_date ){

            if( $result['id'] ){

                if( $result['chiqim_miqdor'] ){
                    
                    $miqdor_summ = $kirim['miqdori_kg'] + $result['kirim_miqdor'];
                    
                    $qoldiq = $miqdor_summ - $result['chiqim_miqdor'];
                    $id = $result['id'];
                    Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi', `kirim_miqdor` = '$miqdor_summ', `qoldiq` = '$qoldiq' WHERE `sklat`.`id` = '$id'")->execute();

                }else{

                    $miqdor_summ = $kirim['miqdori_kg'] + $result['kirim_miqdor'];
                    $qoldiq_summ = $kirim['miqdori_kg'] + $result['qoldiq'];

                    $id = $result['id'];

                    Yii::$app->db->createCommand("UPDATE `sklat` SET `kirim_miqdor` = '$miqdor_summ', `qoldiq` = '$qoldiq_summ' WHERE `sklat`.`id` = $id;")->execute();

                }

                $id = $result['id'];
                $miqdor_summ = $kirim['miqdori_kg']+$result['kirim_miqdor'];
                Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi', `kirim_miqdor` = '$miqdor_summ' WHERE `sklat`.`id` = '$id'")->execute();

            }
        }    
        if($result['sana'] != $kirim_date){

            $model_sklat->kirim_miqdor = $kirim['miqdori_kg'];
            $model_sklat->qoldiq = $kirim['miqdori_kg'];
            $model_sklat->nomi = $kirim['nomi'];
            $model_sklat->sana = $kirim['sana'];
            $model_sklat->save();

        }
        

            $model = new Posts();
            $formData = Yii::$app->request->post();

            $model->sana = $kirim_date;
    
            if($model->load($formData)){
                if($model->save()){
                    Yii::$app->getSession()->setFlash('message','Қўшилди');
                    return $this->redirect(['index']);
                }
                else{
                    Yii::$app->getSession()->setFlash('message','Юбориш учун ариза топширилди');
                }
            }       
                
       

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $kirim = Yii::$app->request->post('Posts');
        $model->sana = $kirim['sana'];

        $nomi = $kirim['nomi'];
        $kirim_date = $kirim['sana'];

        $idd = $id;
        // sklatdan topib olish uchun kirimdan malumot olindi
        $update_keldi = Yii::$app->db->createCommand("SELECT * FROM `posts` WHERE `id` LIKE '$idd'");
        $res = $update_keldi->queryOne();

        // ***

        // kirimdan olingan malumotlar
        $update_sklat_nomi = $res['nomi'];
        $update_sklat_sana = $res['sana'];
        // ***

        // Update qilish uchun shu sanadagi malumotni sklatdan olish
        $update_select = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$update_sklat_nomi' AND `sana` LIKE '$update_sklat_sana'");
        $res_update = $update_select->queryOne();
        // ***
        // malumotlar sklatni update qilish uchun
        $nomi_sklat = $res_update['nomi'];
        $miqdor_min = $res_update['kirim_miqdor'] - $kirim['miqdori_kg'];
        $qoldiq_min = $res_update['qoldiq'] - $kirim['miqdori_kg'];
        $id_update = $res_update['id'];
        // ***
        
        // if ($res_update['kirim_miqdor'] == $kirim['miqdori_kg']){
        //     $ids = intval( $id_update );
        //     Yii::$app->db->createCommand("DELETE FROM `sklat` WHERE `sklat`.`id` = $ids");
        // }

        $id_sklat = $res_update['id'];
        Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi_sklat', `kirim_miqdor` = '$miqdor_min', `qoldiq` = '$qoldiq_min' WHERE `sklat`.`id` = '$id_sklat'")->execute();

        $sklat = new Sklat();
        
        $command = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$nomi' AND `sana` LIKE '$kirim_date'");

        $result = $command->queryOne();

        $miqdor_summ = $result['kirim_miqdor'] + $kirim['miqdori_kg'];
        $qoldiq_summ = $result['qoldiq'] + $kirim['miqdori_kg'];
        $iddd = $result['id'];
        if($kirim['nomi']){

            if($iddd){

                Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi', `kirim_miqdor` = '$miqdor_summ', `qoldiq` = '$qoldiq_summ' WHERE `sklat`.`id` = '$iddd'")->execute();
            
            }else if(!$iddd){

                $sklat->nomi = $kirim['nomi'];
                $sklat->kirim_miqdor = $kirim['miqdori_kg'];
                $sklat->qoldiq = $kirim['miqdori_kg'];
                $sklat->sana = $kirim['sana'];
                $sklat->save();

            }
        }

        if($model->load(Yii::$app->request->post()) && $model->save() ){
                    Yii::$app->getSession()->setFlash('message', 'Ўзгартириш сақланди');
                    return $this->redirect(['view','id' => $model->id]);
                }
                else{
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }

       
    }

    public function actionDelete($id)
    {
        // kirimdan o'chirilayotgan kirimni malumoti olindi
        $command = Yii::$app->db->createCommand("SELECT * FROM `posts` WHERE `id` LIKE '$id'");
        $kirim_res = $command->queryOne();

        $kirim_nomi = $kirim_res['nomi'];
        $kirim_sana = $kirim_res['sana'];
        // ***

        // sklatdan o'chirilayotgan malumotni olish
        $command_sklat = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$kirim_nomi' AND `sana` LIKE '$kirim_sana'");
        $sklat_res = $command_sklat->queryOne();
        // ***

        $sklat_id = $sklat_res['id'];
        $sklat_miqdor = $sklat_res['kirim_miqdor'] - $kirim_res['miqdori_kg'];
        $sklat_qoldiq = $sklat_res['qoldiq'] - $kirim_res['miqdori_kg'];

        Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$kirim_nomi', `kirim_miqdor` = '$sklat_miqdor', `qoldiq` = '$sklat_qoldiq' WHERE `sklat`.`id` = '$sklat_id'")->execute();

        $this->findModel($id)->delete();
        
        
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /*
    EXPORT WITH PHPEXCEL
	*/ 
	
    
}
