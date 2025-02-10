<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carpetaregistro $model */

$this->title = 'Editar Carpeta De Registro: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Carpetaregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'nombre' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="carpetaregistro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
