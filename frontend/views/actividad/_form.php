<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\StringHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;



/* @var $this yii\web\View */
/* @var $model frontend\models\Actividad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?php if($model->isNewRecord) {
                echo $form->field($model, 'codigo_caso')->textInput(['readonly' => true, 'value' => $model->getCodigoActividad()], ['maxlength' => true]);
            }
            else{
                echo $form->field($model, 'codigo_caso')->textInput(['readonly' => true, 'value' => $model->codigo_caso], ['maxlength' => true]);
            } ?>
        </div>


        <div class="col-lg-3">
            <?= $form->field($model, 'id_analista')->dropDownList($model->getAnalista()) ?>
        </div>
        <div class="col-lg-3">
            <?php 
                //echo $form->field($model, 'id_usuario')->dropDownList($model->getUsuario());
                echo $form->field($model, 'id_usuario')->widget(Select2::classname(), [
                    'data' => $model->getUsuario(),
                    'options' => ['placeholder' => 'Seleccione un usuario ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'id_bd')->dropDownList($aplicaciones) ?>
        </div>
    </div>
    <?= $form->field($model, 'id_proyecto')->dropDownList($model->getProyecto()) ?>
    <?php
        // Parent
        echo $form->field($model, 'id_proceso')->dropDownList($model->getProceso(), [
            'id'=>'id_proceso',
            'prompt'=>'Seleccione un proceso...',
        ]); 

        // Child # 1
        echo $form->field($model, 'id_macro')->widget(DepDrop::classname(), [
            'options'=>['id'=>'id_macro'],
            'pluginOptions'=>[
                'depends'=>['id_proceso'],
                'placeholder'=>'Seleccione un servicio...',
                'url'=>Url::to(['/actividad/servicio'])
            ]
        ]);
        // Child # 2
        echo $form->field($model, 'id_detallada')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>['id_proceso', 'id_macro'],
                'placeholder'=>'Seleccione una actividad...',
                'url'=>Url::to(['/actividad/actividad'])
            ]
        ]);
    ?>
    <div class="row">
        <div class="col-lg-6">
            <?php 
             if(StringHelper::explode(date('Y/m/d'),'/')[2]>24){
                $fecha=StringHelper::explode(date('Y/m/d'),'/')[0].'/' .(StringHelper::explode(date('Y/m/d'),'/')[1]).'-25';
            }else
                $fecha=StringHelper::explode(date('Y/m/d'),'/')[0].'/' .(StringHelper::explode(date('Y/m/d'),'/')[1]-1).'-25';
            echo $form->field($model, 'fecha_atencion')->widget(DatePicker::className(),
                [
                    'name' => 'fecha_ini_aten',
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'value' => date('Y/m/d'),
                    'readonly' => true,
                    'language' => 'es',
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy/mm/dd',
                        'autoclose' => true,
                        //'daysOfWeekDisabled' => [0, 6],
                        //'startDate'=>$fecha,
                        'todayHighlight' => true
                    ]
                ]); ?>
        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'hora_ini')->widget(TimePicker::className(),[
                'pluginOptions' => [
                    'showMeridian' => false,
                    'minuteStep' => 5,
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'hora_fin')->widget(TimePicker::className(),[
                'pluginOptions' => [
                    'showMeridian' => false,
                    'minuteStep' => 5,
                ]
            ]) ?>
        </div>
    </div>

    <?php // $form->field($model, 'HH')->textInput(['id'=>'HH']) ?>



    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>



    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>