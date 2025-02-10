<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UnidadDeExplotacion $model */

$this->title = 'Editar Unidad De Explotacion: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Unidadexplotacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'nombre' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="unidadexplotacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
