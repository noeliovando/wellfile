<?php

namespace frontend\controllers;

use frontend\models\Pozo;
use frontend\models\search\PozoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PozoController implements the CRUD actions for Pozo model.
 */
class PozoController extends BaseController
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
     * Lists all Pozo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PozoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pozo model.
     * @param string $nombre_finder Nombre Finder
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nombre_finder)
    {
        return $this->render('view', [
            'model' => $this->findModel($nombre_finder),
        ]);
    }

    /**
     * Creates a new Pozo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pozo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nombre_finder' => $model->nombre_finder]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pozo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nombre_finder Nombre Finder
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nombre_finder)
    {
        $model = $this->findModel($nombre_finder);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nombre_finder' => $model->nombre_finder]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pozo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nombre_finder Nombre Finder
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nombre_finder)
    {
        $this->findModel($nombre_finder)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pozo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nombre_finder Nombre Finder
     * @return Pozo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nombre_finder)
    {
        if (($model = Pozo::findOne(['nombre_finder' => $nombre_finder])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
