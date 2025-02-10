<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/** @var yii\web\View $this */
/** @var app\models\documentos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_subcarpeta')->dropDownList($model->getSubcarpetas()) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'fecha')->widget(DatePicker::className(),
                [  'name' => 'fecha',
                    'type' => DatePicker::TYPE_INPUT,
                    'value' => date('Y/m/d'),
                    'size' => 'lg',
                    'readonly' => true,
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy/mm/dd',
                        'autoclose' => true,
                        'daysOfWeekDisabled' => [0, 6],
                        'todayBtn' => true,
                        //'startDate'=>$fecha,
                        'todayHighlight' => true]
                    ])?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
