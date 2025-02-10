<?php

namespace frontend\helpers;

class MenuHelper
{
    // Definir constantes para los roles de usuario
    const ROLE_ADMIN = '2';      // Admin
    const ROLE_ANALYST = '3';    // Analista
    const ROLE_LEADER = '4';     // Líder

    /**
     * Genera los ítems del menú basados en el rol del usuario.
     *
     * @return array
     */
    public static function getMenuItems(): array
    {
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
        ];

        if (\Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registro de Usuario', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Iniciar Sesión', 'url' => ['/site/login']];
        } else {
            $menuItems = array_merge($menuItems, self::getAuthenticatedMenuItems());
            $menuItems[] = self::getUserProfileMenu();
        }

        return $menuItems;
    }

    /**
     * Genera los ítems del menú para usuarios autenticados.
     *
     * @return array
     */
    private static function getAuthenticatedMenuItems(): array
    {
        $menuItems = [];

        // Menú para Admin, Analista y Líder
        if (self::isUserInRole([self::ROLE_ADMIN, self::ROLE_ANALYST, self::ROLE_LEADER])) {
            $menuItems[] = ['label' => 'Usuarios', 'url' => ['/usuarios']];
            $menuItems[] = ['label' => 'Expedientes', 'url' => ['/expediente']];
            $menuItems[] = ['label' => 'Pozos', 'url' => ['/pozo']];
        }

        // Menú para Admin y Analista
        if (self::isUserInRole([self::ROLE_ADMIN, self::ROLE_ANALYST])) {
            $menuItems[] = ['label' => 'Analistas', 'url' => ['/analista']];
        }

        // Menú exclusivo para Admin
        if (self::isUserInRole([self::ROLE_ADMIN])) {
            $menuItems[] = ['label' => 'Usuarios Contraseña', 'url' => ['/user']];
            $menuItems[] = ['label' => 'Ingresar trabajador', 'url' => ['/user']];
            $menuItems[] = [
                'label' => 'Admin', 'items' => [
                    ['label' => 'Rol', 'url' => ['/rol']],
                    ['label' => 'Operaciones', 'url' => ['/operacion']],
                ]
            ];
        }

        return $menuItems;
    }

    /**
     * Genera el menú de perfil del usuario.
     *
     * @return array
     */
    private static function getUserProfileMenu(): array
    {
        return [
            'label' => 'Bienvenid@ ' . \Yii::$app->user->identity->nombre,
            'items' => [
                ['label' => 'Opciones de Perfil'],
                ['label' => 'Modificar Contraseña', 'url' => ['/site/reset-password']],
                ['label' => 'Cerrar Sesión (' . \Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']],
            ]
        ];
    }

    /**
     * Verifica si el usuario tiene uno de los roles especificados.
     *
     * @param array $roles
     * @return bool
     */
    private static function isUserInRole(array $roles): bool
    {
        return !\Yii::$app->user->isGuest && in_array(\Yii::$app->user->identity->rol_id, $roles);
    }
}