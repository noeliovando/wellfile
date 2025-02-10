<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PozoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pozo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nombre_finder') ?>

    <?= $form->field($model, 'id_campo') ?>

    <?= $form->field($model, 'id_unidad_exp') ?>

    <?= $form->field($model, 'id_division') ?>

    <?= $form->field($model, 'spud_date') ?>

    <?php // echo $form->field($model, 'nombre_simde') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'id_distrito') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
