<?php

namespace Controllers;

use Classes\Email;
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
                    // Hashear el password
                    $usuario->hashPassword();
                    // Eliminar password2
                    unset($usuario->password2);
                    // Crear token
                    $usuario->crearToken();
                    // Creamos un nuevo usuario
                    $resultado = $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();


                    if ($resultado) {
                        header('Location: /mensaje');
                    }
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
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if (empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);
                if ($usuario && $usuario->confirmado) {
                    // Generar un nuevo token

                    // Actualizar el usuario

                    // Enviar el email

                    // Imprimir la alerta

                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o aún no ha sido confirmado');
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $router->render('auth/olvide', [
            'titulo' => $titulo,
            'alertas' => $alertas
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
        $token = s($_GET['token']);

        if (!$token) header("Location: /");

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // No se encuentra un usuario con ese token
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);

            // Guardar en la base de datos
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }
}
