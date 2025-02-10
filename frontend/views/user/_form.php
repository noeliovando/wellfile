<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-2">
    <?= $form->field($model, 'nombre') ?>
        </div>
        <div class="col-lg-2">
    <?= $form->field($model, 'apellido') ?>
        </div>
        <div class="col-lg-2">
    <?= $form->field($model, 'username') ?>
        </div>
    </div>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'telefono') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
    <?= $form->field($model, 'cedula') ?>
    <?= $form->field($model, 'id_supervisor') ?>
    <?= $form->field($model, 'id_division')->dropDownList($model->getDivisiones()) ?>

    <?php
    if(Yii::$app->user->identity->rol_id=='2') {
        $opciones = \yii\helpers\ArrayHelper::map($tipoAplicaciones, 'id', 'nombre');
        echo $form->field($model, 'aplicaciones')->checkboxList($opciones, ['unselect' => NULL]);
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
