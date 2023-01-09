<?php

namespace Controllers;

use MVC\Router;
use Model\Proyecto;

class DashboardController
{
    public static function index(Router $router)
    {
        isAuth();
        $titulo = "Proyectos";

        $router->render('dashboard/index', [
            'titulo' => $titulo
        ]);
    }

    public static function crear_proyecto(Router $router)
    {
        $titulo = 'Crear proyecto';
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            // Validación
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                // Guardar proyecto

            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => $titulo,
            'alertas' => $alertas
        ]);
    }

    public static function perfil(Router $router)
    {
        $titulo = 'Perfil';
        $router->render('dashboard/perfil', [
            'titulo' => $titulo
        ]);
    }
}
