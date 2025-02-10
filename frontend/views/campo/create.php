<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Campo $model */

$this->title = 'Create Campo';
$this->params['breadcrumbs'][] = ['label' => 'Campos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
