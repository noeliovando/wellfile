<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carpeta $model */

$this->title = 'Ingresar Carpeta';
$this->params['breadcrumbs'][] = ['label' => 'Carpetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carpeta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
