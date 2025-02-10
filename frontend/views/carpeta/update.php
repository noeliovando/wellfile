<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carpeta $model */

$this->title = 'Editar Carpeta: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Carpetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'nombre' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="carpeta-Editar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
