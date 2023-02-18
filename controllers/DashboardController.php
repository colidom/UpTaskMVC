<?php

namespace Controllers;

use MVC\Router;
use Model\Proyecto;
use Model\Usuario;

class DashboardController
{
    public static function index(Router $router)
    {
        isAuth();
        $titulo = "Proyectos";
        $id = $_SESSION['id'];
        $proyectos = Proyecto::belongsTo('propietarioId', $id);

        $router->render('dashboard/index', [
            'titulo' => $titulo,
            'proyectos' => $proyectos
        ]);
    }

    public static function crear_proyecto(Router $router)
    {
        isAuth();
        $titulo = 'Crear proyecto';
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            // Validación
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                // Generar una URL única
                $proyecto->url = md5(uniqid());
                // Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                // Guardar proyecto
                $proyecto->guardar();
                // Redireccionar
                header('Location: /proyecto?url=' . $proyecto->url);
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router)
    {
        isAuth();
        $token = $_GET['id'];
        if (!$token) header("Location: /dashboard");

        // Revisar que el usuario que visita el proyecto es el propietario
        $proyecto = Proyecto::where('url', $token);
        if ($proyecto->propietarioId !== $_SESSION['id']) {
            header("Location: /dashboard");
        }

        $titulo = $proyecto->proyecto;
        $alertas = [];

        $router->render('dashboard/proyecto', [
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }

    public static function perfil(Router $router)
    {
        isAuth();

        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPerfil();

            if (empty($alertas)) {

                // Verificar  que no exista un email previo
                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    // Mostrar mensaje de error
                    Usuario::setAlerta('error', 'El email introducido ya está en uso');
                } else {
                    // Guardar el usuario
                    $usuario->guardar();
                    Usuario::setAlerta('exito', 'Usuario guardado correctamente');
                }

                $alertas = Usuario::getAlertas();

                // Asignar nombre nuevo en barra superior
                $_SESSION['nombre'] = $usuario->nombre;
                $_SESSION['email'] = $usuario->email;
            }
        }

        $titulo = 'Perfil';
        $router->render('dashboard/perfil', [
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiar_password(Router $router)
    {
        isAuth();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);

            // Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevo_password();

            if (empty($alertas)) {
                $resultado = $usuario->comprobar_password();

                if ($resultado) {
                    $usuario->password = $usuario->password_nuevo;

                    // Eliminamos la contraseña actual y nueva del objeto usuario
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    // Hashear el nuevo password
                    $usuario->hashPassword();

                    // Actualizar 
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Contraseña actualizada correctamente');
                        $alertas = Usuario::getAlertas();
                    }
                } else {
                    Usuario::setAlerta('error', 'La contraseña actual introducida es incorrecta');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $titulo = 'Cambiar contraseña';
        $router->render('dashboard/cambiar-password', [
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }
}
