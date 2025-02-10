<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Expediente $model */

$this->title = $model->nombre_expediente;
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expediente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nombre_expediente' => $model->nombre_expediente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nombre_expediente' => $model->nombre_expediente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre_expediente',
            'finder',
            'cant_historias',
            'cant_carp_perfiles',
            'id_status',
            'accion_inmediata',
            'observacion',
        ],
    ]) ?>

</div>
