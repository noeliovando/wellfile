<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CampoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="campo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codigo_campo') ?>

    <?= $form->field($model, 'nombre_campo') ?>

    <?= $form->field($model, 'ue_campo') ?>

    <?= $form->field($model, 'county') ?>

    <?php // echo $form->field($model, 'district') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
