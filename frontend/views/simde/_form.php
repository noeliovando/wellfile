<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Simde $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="simde-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_simde')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cant_documentos')->textInput() ?>

    <?= $form->field($model, 'id_formato')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
