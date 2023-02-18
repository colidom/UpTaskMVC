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

        $titulo = 'Perfil';
        $router->render('dashboard/perfil', [
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}
