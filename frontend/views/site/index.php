<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="site-index">
<div class="site-index">
    <div class="bg-transparent rounded-3">
        <div class="container-fluid py-4">
        <h1 class="display-5">¡Bienvenidos!</h1>
            <p class="fs-5 fw-light">Slecciona alguna de las actividades</p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="container-fluid py-3">
                <h3>Usuarios</h3>
                <?= Html::a('Usuarios', ['/usuarios'])?></br>
            </div>
            <div class="container-fluid py-3">
                <h3>Actividades</h3>
                <?= Html::a('Actividades', ['/actividad'])?>
                
            </div>
            <div class="container-fluid py-3">
                <h3>Estadisticas</h3>

                <?= Html::a('Estadisticas del Proceso', ['/reporte'])?></br>
                <?= Html::a('Estadisticas por trabajador', ['/estadistica'])?>
            </div>
            <div class="container-fluid py-3">
                <h3>Perfil</h3>

                <?= Html::a('Modificar Contraseña', ['/site/reset-password'])?></br>
                <?= Html::a('Cerrar Sesión', ['/site/logout'],['data-method' => 'post'])?>
            </div>
        </div>

    </div>
</div>