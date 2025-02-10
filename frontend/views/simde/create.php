<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Simde $model */

$this->title = 'Create Simde';
$this->params['breadcrumbs'][] = ['label' => 'Simdes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simde-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
