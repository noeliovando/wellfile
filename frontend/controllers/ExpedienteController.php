<?php

namespace frontend\controllers;

use frontend\models\Expediente;
use frontend\models\search\ExpedienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpedienteController implements the CRUD actions for Expediente model.
 */
class ExpedienteController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Expediente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExpedienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expediente model.
     * @param string $nombre_expediente Nombre Expediente
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nombre_expediente)
    {
        return $this->render('view', [
            'model' => $this->findModel($nombre_expediente),
        ]);
    }

    /**
     * Creates a new Expediente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Expediente();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nombre_expediente' => $model->nombre_expediente]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Expediente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nombre_expediente Nombre Expediente
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nombre_expediente)
    {
        $model = $this->findModel($nombre_expediente);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nombre_expediente' => $model->nombre_expediente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Expediente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nombre_expediente Nombre Expediente
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nombre_expediente)
    {
        $this->findModel($nombre_expediente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Expediente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nombre_expediente Nombre Expediente
     * @return Expediente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nombre_expediente)
    {
        if (($model = Expediente::findOne(['nombre_expediente' => $nombre_expediente])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
