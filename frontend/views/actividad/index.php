<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use kartik\daterange\DateRangePicker;



/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ActividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actividades';
$this->params['breadcrumbs'][] = $this->title;
$botones ='{view} {update} {delete} {clonar} ';
?>
<div class="actividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4'? Html::a('Crear Actividad', ['create'], ['class' => 'btn btn-success']):'' ?>
    </p>
<?php
    $gridColumns = [
        'id_actividad',
        'codigo_caso',
        [
            'label' => 'Ususario',
            'attribute' => 'usuarioNombre',
        ],
        [
            'label' => 'Organizacion',
            'attribute' => 'organizacionNombre',
        ],
        [
            'label' => 'Proyecto',
            'attribute' => 'proyectoNombre',
        ],
        [
            'label'=>'Empresa',
            'value'=>'empresaNombre',
        ],
        [
            'label' => 'Division',
            'attribute' => 'divisionNombre',
        ],
        [
            'label'=>'Proceso',
            'value'=>'procesoNombre',
        ],
        [
            'label'=>'Analista',
            'value'=>'analistaUsername',
        ],
        // 'id_via',
        [
            'label'=>'Aplicacion/BD',
            'value'=>'aplicacionNombre',
        ],
        [
            'label'=>'Servicio',
            'value'=>'macroNombre',
        ],
        [
            'label'=>'Actividad',
            'value'=>'detalladaNombre',
        ],
        [
            'attribute'=>'fecha_atencion',
            'format' => ['date', 'php:d/m/Y'],
        ],
        'hora_ini',
        // 'fecha_fin_aten',
        // 'hora_fin',
        [
            'attribute'=>'HH',
            'format' => ['decimal',2]
        ],
        // 'id_status',
        'detalle:ntext',
        // 'pozo',
    ];
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'fontAwesome' => true,
]);
?>
    <?php
    if(Yii::$app->user->identity->rol_id=='3'||Yii::$app->user->identity->rol_id=='4')
        $botones ='{view} {update} {delete} {clonar} ';
    else
        $botones ='{view} ';
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
        'options' => ['style' => 'font-size:12px;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_actividad',
            'codigo_caso',
            [
                'attribute'=>'id_analista',
                'filter'=>$searchModel->getAnalista(),
                'label'=>'Analista',
                'value'=>'analistaUsername',
            ],
            [
                'attribute'=>'id_usuario',
                'filter'=>$searchModel->getUsuario(),
                'label'=>'Usuario',
                'value'=>'usuarioNombre',
            ],
            // 'id_via',
            [
                'attribute'=>'id_bd',
                'filter'=>$searchModel->getAplicacion(),
                'label'=>'Aplicacion/BD',
                'value'=>'aplicacionNombre',
            ],
            [
                'attribute'=>'id_organizacion',
                'filter'=>$searchModel->getOrganizacion(),
                'label'=>'Organización',
                'value'=>'organizacionNombre',
            ],
            [
                'attribute'=>'id_empresa',
                'filter'=>$searchModel->getEmpresa(),
                'label'=>'Empresa',
                'value'=>'empresaNombre',
            ],
            [
                'attribute'=>'id_division',
                'filter'=>$searchModel->getDivision(),
                'label'=>'Division',
                'value'=>'divisionNombre',
            ],
            [
                'attribute'=>'id_proceso',
                'filter'=>$searchModel->getProceso(),
                'label'=>'Proceso',
                'value'=>'procesoNombre',
            ],
            [
                'attribute'=>'id_macro',
                'filter'=>$searchModel->getActividadMacro(),
                'label'=>'Actividad Macro',
                'value'=>'macroNombre',
            ],
            [
                'attribute'=>'id_detallada',
                'filter'=>$searchModel->getActividadDetallada(),
                'label'=>'Actividad Detallada',
                'value'=>'detalladaNombre',
            ],
            //'fecha_requerimiento',
            // 'hora_requerimiento',
            /*[
                'attribute'=>'fecha_atencion',
                'format' => ['date', 'php:d/m/Y'],
            ],*/
            [
                'attribute'=>'fecha_atencion',
                'format' => ['date', 'php:d/m/Y'],
                'filter' =>
                DateRangePicker::widget([
                    'name' => 'createTimeRange',
                    'attribute' => 'fecha_atencion',
                    'convertFormat' => true,
                    //'startAttribute'=> date('Y-m-d h:i'),
                    //'endAttribute'=>date('Y-m-d h:i'),
                    'presetDropdown' => true,
                    'pluginOptions' => [
                        'timePicker' => true,
                        'timePickerIncrement' => 1,
                        'locale' => [
                            'format' => 'Y-m-d h:i:s'
                        ]
                    ]
                ])
            ],
             'hora_ini',
            // 'fecha_fin_aten',
            // 'hora_fin',
            [
                'attribute'=>'HH',
                'format' => ['decimal',2]
            ],
            // 'id_status',
            [
                'attribute'=>'detalle',
                'value'=>'detalle',
                'contentOptions'=>['style'=>'min-width: 300px;']
            ],
            // 'pozo',

            ['class' => 'yii\grid\ActionColumn',
                'template' => $botones,
                'buttons' => [
                    'clonar' => function ($url, $model) {
                        return Html::a('<svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="currentcolor"  width="32" height="32" viewBox="0 0 24 24" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                    </svg>', $url, [
                            'title' => Yii::t('yii', 'Clonar'),
                            'aria-label="Clonar"',
                            'Data-pjax="0"',
                        ]);
                    },

                ],

            ],
        ],
        ]
    ); ?>

</div>
