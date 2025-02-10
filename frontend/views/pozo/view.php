<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pozo $model */

$this->title = $model->nombre_finder;
$this->params['breadcrumbs'][] = ['label' => 'Pozos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pozo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'nombre_finder' => $model->nombre_finder], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nombre_finder' => $model->nombre_finder], [
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
            'nombre_finder',
            'id_campo',
            'id_unidad_exp',
            'id_division',
            'spud_date',
            'nombre_simde',
            'observacion',
            'id_distrito',
        ],
    ]) ?>

</div>
