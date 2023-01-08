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
}
