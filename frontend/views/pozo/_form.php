<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pozo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pozo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_finder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_campo')->textInput() ?>

    <?= $form->field($model, 'id_unidad_exp')->textInput() ?>

    <?= $form->field($model, 'id_division')->textInput() ?>

    <?= $form->field($model, 'spud_date')->textInput() ?>

    <?= $form->field($model, 'nombre_simde')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_distrito')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
