<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=>'GODD',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [//add by Scott
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true, // Habilita URLs amigables
            'showScriptName' => false, // Oculta "index.php" en la URL
            'rules' => [
                // Define tus reglas de enrutamiento aquí
                'pozo' => 'pozo/index', // Ejemplo: /pozo -> pozo/index
                'pozo/<action:\w+>' => 'pozo/<action>', // Ejemplo: /pozo/create -> pozo/create
            ],
        ],
    ],
    'params' =>[
        'bsVersion' => '4.x',
    ],
];
