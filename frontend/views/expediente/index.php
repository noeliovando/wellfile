<?php

use frontend\models\Expediente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\ExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Expediente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre_expediente',
            'finder',
            'cant_historias',
            'cant_carp_perfiles',
            [
                'attribute'=>'id_status',
                'filter'=>$searchModel->getStatus(),
                'label'=>'Status',
                'value'=>'statusNombre',
            ],
            //'accion_inmediata',
            //'observacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Expediente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'nombre_expediente' => $model->nombre_expediente]);
                 }
            ],
        ],
    ]); ?>


</div>
