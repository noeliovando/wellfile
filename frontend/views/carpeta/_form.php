<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Carpeta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carpeta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'digital')->textInput() ?>

    <?= $form->field($model, 'fisico')->textInput() ?>

    <?= $form->field($model, 'vagon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_pozo')->dropDownList($model->getPozos()) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
