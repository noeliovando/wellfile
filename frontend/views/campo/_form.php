<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Campo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="campo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_campo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_campo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ue_campo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
