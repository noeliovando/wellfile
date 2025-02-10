<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Unidadexplotacion $model */

$this->title = 'Update Unidadexplotacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unidadexplotacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unidadexplotacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
