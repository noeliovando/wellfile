<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pozo $model */

$this->title = 'Create Pozo';
$this->params['breadcrumbs'][] = ['label' => 'Pozos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pozo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
