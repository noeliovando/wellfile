<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Expediente $model */

$this->title = 'Update Expediente: ' . $model->nombre_expediente;
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_expediente, 'url' => ['view', 'nombre_expediente' => $model->nombre_expediente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expediente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
