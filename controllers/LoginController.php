<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $titulo = "Iniciar sesión";
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }

        $router->render('auth/login', [
            'titulo' => $titulo
        ]);
    }

    public static function logout()
    {
        echo "Desde logout";
    }

    public static function crear(Router $router)
    {
        $titulo = "Crear cuenta";
        $router->render('auth/crear', [
            'titulo' => $titulo
        ]);
    }

    public static function olvide(Router $router)
    {
        $titulo = "Olvide cuenta";

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }

        $titulo = "Olvide cuenta";
        $router->render('auth/olvide', [
            'titulo' => $titulo
        ]);
    }

    public static function restablecer(Router $router)
    {
        $titulo = "Restablecer contraseña";

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }

        $titulo = "Restablecer contraseña";
        $router->render('auth/restablecer', [
            'titulo' => $titulo
        ]);
    }

    public static function mensaje()
    {
        echo "Desde mensaje";
    }

    public static function confirmar()
    {
        echo "Desde confirmar";
    }
}
