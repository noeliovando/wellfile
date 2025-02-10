<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Simde $model */

$this->title = 'Update Simde: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Simdes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simde-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
