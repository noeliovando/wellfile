<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pozo $model */

$this->title = 'Update Pozo: ' . $model->nombre_finder;
$this->params['breadcrumbs'][] = ['label' => 'Pozos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_finder, 'url' => ['view', 'nombre_finder' => $model->nombre_finder]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pozo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
