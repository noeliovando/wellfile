<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tarea $model */

$this->title = 'Create Tarea';
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarea-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
