<?php

namespace app\controllers;

use Yii;
use app\models\Chiqim;
use app\models\Sklat;
use app\models\ChiqimSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\db\Query;

/**
 * ChiqimController implements the CRUD actions for Chiqim model.
 */
class ChiqimController extends Controller
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
     * Lists all Chiqim models.
     * @return mixed
     */
    public function actionIndex($xaridor_id=null)
    {
        $searchModel = new ChiqimSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$xaridor_id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chiqim model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Chiqim model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chiqim();

        $formData = Yii::$app->request->post();
        
        $chiqim = Yii::$app->request->post('Chiqim');

        $nomi = $chiqim['nomi'];
        $date_s = $chiqim['sana'];


        $model_sklat = new Sklat();

        $command = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$nomi' AND `sana` LIKE '$date_s'");
        
        $result = $command->queryOne();

        $id = $result['id'];
        $chiqim_miqdor = $chiqim['miqdori_kg'] + $result['chiqim_miqdor'];
        $qoldiq = $result['kirim_miqdor']-$chiqim_miqdor;

        if( $result['sana'] == $chiqim['sana'] ){

            if($id){

                if($date_s == $result['sana']){

                    Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi', `chiqim_miqdor` = '$chiqim_miqdor', `qoldiq` = '$qoldiq' WHERE `sklat`.`id` = '$id'")->execute();
                }

            }

        }
        if( $result['sana'] != $chiqim['sana'] ){

            $chiqim_miqdor = $chiqim['miqdori_kg'];
            if( $chiqim_miqdor != 0 ){
                Yii::$app->db->createCommand("INSERT INTO `sklat` (`nomi`, `chiqim_miqdor`, `qoldiq`, `sana`) VALUES ( '$nomi', '$chiqim_miqdor', '$qoldiq', '$date_s')")->execute();
            }
        }

        if($model->load($formData)){
            $model->jami_sum= $model->narxi * $model->miqdori_kg;
            $model->qolgan_sum= $model->berilgan_sum - $model->jami_sum;
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

    /**
     * Updates an existing Chiqim model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         
        $chiqim = Yii::$app->request->post('Chiqim');
        $model->sana = $chiqim['sana'];

        $nomi = $chiqim['nomi'];
        $chiqim_date = $chiqim['sana'];

        $idd = $id;
        // sklatdan topib olish uchun kirimdan malumot olindi
        $update_keldi = Yii::$app->db->createCommand("SELECT * FROM `chiqim` WHERE `id` LIKE '$idd'");
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
        $miqdor_min = $res_update['chiqim_miqdor'] - $chiqim['miqdori_kg'];
        $qoldiq_min = $res_update['qoldiq'] + $chiqim['miqdori_kg'];
        $id_update = $res_update['id'];
        // ***
        
        // if ($res_update['chiqim_miqdor'] == $chiqim['miqdori_kg']){
        //     var_dump($id_update);
        //     Yii::$app->db->createCommand("DELETE FROM `sklat` WHERE `sklat`.`id` = 323");
        // }

        $id_sklat = $res_update['id'];
        Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi_sklat', `chiqim_miqdor` = '$miqdor_min', `qoldiq` = '$qoldiq_min' WHERE `sklat`.`id` = '$id_sklat'")->execute();

        $sklat = new Sklat();
        
        $command = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$nomi' AND `sana` LIKE '$chiqim_date'");

        $result = $command->queryOne();

        $miqdor_summ = $result['chiqim_miqdor'] + $chiqim['miqdori_kg'];
        $qoldiq_summ = $result['qoldiq'] - $chiqim['miqdori_kg'];
        $iddd = $result['id'];
        if($chiqim['nomi']){
            if ($iddd){

                Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$nomi', `chiqim_miqdor` = '$miqdor_summ', `qoldiq` = '$qoldiq_summ' WHERE `sklat`.`id` = '$iddd'")->execute();
            
            }else if(!$iddd){
                $nomi = $chiqim['nomi'];
                $chiqim_miqdor = $chiqim['miqdori_kg'];
                $qoldiq = $result['kirim_miqdor'] - $chiqim['miqdori_kg'];
                $sana = $chiqim['sana'];
                Yii::$app->db->createCommand("INSERT INTO `sklat` (`nomi`, `chiqim_miqdor`, `qoldiq`, `sana`) VALUES ( '$nomi', '$chiqim_miqdor', '$qoldiq', '$sana')")->execute();

            }
        }

        if($model->load(Yii::$app->request->post())){
          $model->jami_sum= $model->narxi * $model->miqdori_kg;
          $model->qolgan_sum= $model->berilgan_sum - $model->jami_sum;
          if ($model->save()){
             Yii::$app->getSession()->setFlash('message', 'Ўзгартириш сақланди');
             return $this->redirect(['view','id' => $model->id]);
           }
        }
        else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    
    }

    /**
     * Deletes an existing Chiqim model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // chiqimdan o'chirilayotgan kirimni malumoti olindi
        $command = Yii::$app->db->createCommand("SELECT * FROM `chiqim` WHERE `id` LIKE '$id'");
        $chiqim_res = $command->queryOne();

        $chiqim_nomi = $chiqim_res['nomi'];
        $chiqim_sana = $chiqim_res['sana'];
        // ***

        // sklatdan o'chirilayotgan malumotni olish
        $command_sklat = Yii::$app->db->createCommand("SELECT * FROM `sklat` WHERE `nomi` LIKE '$chiqim_nomi' AND `sana` LIKE '$chiqim_sana'");
        $sklat_res = $command_sklat->queryOne();
        // ***

        $sklat_id = $sklat_res['id'];
        $sklat_miqdor = $sklat_res['chiqim_miqdor'] - $chiqim_res['miqdori_kg'];
        $sklat_qoldiq = $sklat_res['qoldiq'] + $chiqim_res['miqdori_kg'];

        Yii::$app->db->createCommand("UPDATE `sklat` SET `nomi` = '$chiqim_nomi', `chiqim_miqdor` = '$sklat_miqdor', `qoldiq` = '$sklat_qoldiq' WHERE `sklat`.`id` = '$sklat_id'")->execute();


        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chiqim model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chiqim the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chiqim::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
