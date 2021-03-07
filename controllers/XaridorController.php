<?php

namespace app\controllers;

use Yii;
use app\models\Xaridor;
use app\models\XaridorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Chiqim;

/**
 * XaridorController implements the CRUD actions for Xaridor model.
 */
class XaridorController extends Controller
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
     * Lists all Xaridor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new XaridorSearch();
        $sum = Chiqim::find()->sum('qolgan_sum');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sum'=>$sum
        ]);
    }

    /**
     * Displays a single Xaridor model.
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
     * Creates a new Xaridor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Xaridor();
        $model->sana = date('Y-m-d');
        $formData = Yii::$app->request->post();
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

    /**
     * Updates an existing Xaridor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->sana = date('Y-m-d');
        if($model->load(Yii::$app->request->post()) && $model->save() ){
                    Yii::$app->getSession()->setFlash('message', 'Ўзгартириш сақланди');
                    return $this->redirect(['view','id' => $model->xaridor_id]);
                }
                else{
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }

    }

    /**
     * Deletes an existing Xaridor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Xaridor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Xaridor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Xaridor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

  
}
