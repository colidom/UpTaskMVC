<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

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
        $alertas = [];
        $usuario = new Usuario();

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                // Comprobamos si el email ya está en uso
                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'Error: Ya existe un usuario con el email ' . $usuario->email);
                    $alertas = Usuario::getAlertas();
                } else {
                    // Creamos un nuevo usuario
                }
            }
        }

        $router->render('auth/crear', [
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
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

        $router->render('auth/restablecer', [
            'titulo' => $titulo
        ]);
    }

    public static function mensaje(Router $router)
    {
        $titulo = "Cuenta creada exitosamente";

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }

        $router->render('auth/mensaje', [
            'titulo' => $titulo
        ]);
    }

    public static function confirmar(Router $router)
    {
        $titulo = "Cuenta confirmada exitosamente";

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }

        $router->render('auth/confirmar', [
            'titulo' => $titulo
        ]);
    }
}
