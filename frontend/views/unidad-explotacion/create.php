<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Unidadexplotacion $model */

$this->title = 'Ingresar Unidad Explotacion';
$this->params['breadcrumbs'][] = ['label' => 'Unidad Explotacion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidadexplotacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
