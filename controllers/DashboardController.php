<?php

namespace Controllers;

use MVC\Router;

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
        $router->render('dashboard/crear-proyecto', [
            'titulo' => $titulo
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
