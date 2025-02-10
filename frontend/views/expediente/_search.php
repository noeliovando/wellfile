<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ExpedienteSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="expediente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nombre_expediente') ?>

    <?= $form->field($model, 'finder') ?>

    <?= $form->field($model, 'cant_historias') ?>

    <?= $form->field($model, 'cant_carp_perfiles') ?>

    <?= $form->field($model, 'id_status') ?>

    <?php // echo $form->field($model, 'accion_inmediata') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
