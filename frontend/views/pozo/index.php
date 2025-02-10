<?php

use frontend\models\Pozo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\PozoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pozos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pozo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pozo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre_finder',
            [
                'attribute'=>'id_campo',
                'filter'=>$searchModel->getCampo(),
                'label'=>'Campo',
                'value'=>'campoNombre',
            ],
            [
                'attribute'=>'id_distrito',
                'filter'=>$searchModel->getDistrito(),
                'label'=>'Distrito',
                'value'=>'distritoNombre',
            ],
            [
                'attribute'=>'id_unidad_exp',
                'filter'=>$searchModel->getUnidadExp(),
                'label'=>'Unidad de Explotación',
                'value'=>'unidadexpNombre',
            ],
            [
                'attribute'=>'id_division',
                'filter'=>$searchModel->getDivision(),
                'label'=>'División',
                'value'=>'divisionNombre',
            ],
            'spud_date',
            'nombre_simde',
            'observacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pozo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'nombre_finder' => $model->nombre_finder]);
                 }
            ],
        ],
    ]); ?>


</div>
