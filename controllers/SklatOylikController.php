<?php

namespace app\controllers;

use Yii;
use app\models\Sklat;
use app\models\SklatOylikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SklatOylikController implements the CRUD actions for Sklat model.
 */
class SklatOylikController extends Controller
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
     * Lists all Sklat models.
     * @return mixed
     */
    public function actionIndex($date){

        //var_dump(date('Y-m'));

        $searchModel = new SklatOylikSearch();

        $sklat = new Sklat();

        $command = Yii::$app->db->createCommand("SELECT * FROM `sklat`");    
        $dataProvider = $command->queryAll();

        $data = array();
        $date_olgan = substr ($date, 6, 7) - 1;
        $date_otgan_oy = substr ($date, 0, 6) . $date_olgan;

        $data_hammasi = [];
        $data_hammasi_otgan_oy = [];
        $count = 0;
        $counte = 0;

        foreach ( $dataProvider as $data ){
            $count++;
            if ( substr($data['sana'], 0, 7) == $date ){
                  array_push($data_hammasi , $data);
            }
        }

        foreach ( $dataProvider as $data_otgan_oy ){
            $count_otgan_oy++;
            if ( substr($data_otgan_oy['sana'], 0, 7) == $date_otgan_oy ){
                  array_push($data_hammasi_otgan_oy , $data_otgan_oy);
            }
        }

        for ( $i=0; $i<$count; $i++ ){
            for ( $j=$i+1; $j<$count; $j++ ){

                if($data_hammasi[$i]['nomi'] == $data_hammasi[$j]['nomi']){
                    $data_hammasi[$i]['kirim_miqdor'] += $data_hammasi[$j]['kirim_miqdor'];
                    $data_hammasi[$i]['chiqim_miqdor'] += $data_hammasi[$j]['chiqim_miqdor'];
                    $data_hammasi[$i]['qoldiq'] += $data_hammasi[$j]['qoldiq'];
                    unset($data_hammasi[$j]);
                }
            }
        }

        for ( $i=0; $i<$count_otgan_oy; $i++ ){
            for ( $j=$i+1; $j<$count_otgan_oy; $j++ ){

                if($data_hammasi_otgan_oy[$i]['nomi'] == $data_hammasi_otgan_oy[$j]['nomi']){
                    $data_hammasi_otgan_oy[$i]['kirim_miqdor'] += $data_hammasi_otgan_oy[$j]['kirim_miqdor'];
                    $data_hammasi_otgan_oy[$i]['chiqim_miqdor'] += $data_hammasi_otgan_oy[$j]['chiqim_miqdor'];
                    $data_hammasi_otgan_oy[$i]['qoldiq'] += $data_hammasi_otgan_oy[$j]['qoldiq'];
                    unset($data_hammasi_otgan_oy[$j]);
                }
            }
        }
        $data_filter = [];
        $data_filter_otgan_oy = [];

        foreach ($data_hammasi as $data_f){
            if($data_f['nomi']){
                $data_f['qoldiq'] = $data_f['kirim_miqdor'] - $data_f['chiqim_miqdor'];
                array_push($data_filter , $data_f);
            }
        }

        foreach ($data_hammasi_otgan_oy as $data_fe){
            if($data_fe['nomi']){
                $data_fe['qoldiq'] = $data_fe['kirim_miqdor'] - $data_fe['chiqim_miqdor'];
                array_push($data_filter_otgan_oy , $data_fe);
            }
        }

        return $this->render('index', [
            'datas' => $data_filter,
            'date' => $date,
            'datas_otgan' => $data_filter_otgan_oy
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Sklat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sklat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sklat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sklat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
    EXPORT WITH PHPEXCEL
	*/ 
	
    public function actionExportExcel($date)
    {
        $sklat = new Sklat();
        //var_dump($date);
        $command = Yii::$app->db->createCommand("SELECT * FROM `sklat`");    
        $Provider = $command->queryAll();

        $data_hammasi = [];
        $count = 0;

        foreach ( $Provider as $data ){
            $count++;
            if ( substr($data['sana'], 0, 7) == $date ){
                  array_push($data_hammasi , $data);
            }
        }

        for ( $i=0; $i<$count; $i++ ){
            for ( $j=$i+1; $j<$count; $j++ ){

                if($data_hammasi[$i]['nomi'] == $data_hammasi[$j]['nomi']){
                    $data_hammasi[$i]['kirim_miqdor'] += $data_hammasi[$j]['kirim_miqdor'];
                    $data_hammasi[$i]['chiqim_miqdor'] += $data_hammasi[$j]['chiqim_miqdor'];
                    $data_hammasi[$i]['qoldiq'] += $data_hammasi[$j]['qoldiq'];
                    unset($data_hammasi[$j]);
                }
            }
        }

        //var_dump($data_hammasi);

        $dataProvider = [];

        foreach ($data_hammasi as $data_f){
            if($data_f['nomi']){
                $data_f['qoldiq'] = $data_f['kirim_miqdor'] - $data_f['chiqim_miqdor'];
                array_push($dataProvider , $data_f);
            }
        }   
        //var_dump($dataProvider);
        // Initalize the TBS instance
        $OpenTBS = new \hscstudio\export\OpenTBS; // new instance of TBS
        // Change with Your template kaka
		$template = Yii::getAlias('@hscstudio/export').'/templates/opentbs/Склат Ойлик.xlsx';
        $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
        //$OpenTBS->VarRef['modelName']= "Mahasiswa";				
        $data = [];
        $no=1;
        foreach($dataProvider as $mahasiswa){
            $data[] = [
                'no'=>$no++,
                'nomi'=>$mahasiswa['nomi'],
                'kirim'=>$mahasiswa['kirim_miqdor'],
                'chiqim'=>$mahasiswa['chiqim_miqdor'],
                'qoldiq'=>$mahasiswa['qoldiq']
            ];
        }
        $OpenTBS->MergeBlock('data', $data);
        // Output the result as a file on the server. You can change output file
        $OpenTBS->Show(OPENTBS_DOWNLOAD, 'Склат Ойлик.xlsx'); // Also merges all [onshow] automatic fields.			
        exit;
    }

}
