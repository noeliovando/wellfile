<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\subcarpeta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subcarpeta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_carpeta')->dropDownList($model->getCarpetas()) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
