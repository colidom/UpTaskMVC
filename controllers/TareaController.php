<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController
{
    public static function index()
    {
        $proyectoId = $_GET['id'];

        if (!$proyectoId) header('Location: /dashboard');

        $proyecto = Proyecto::where('url', $proyectoId);
        if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) header('Location: /404');

        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);

        echo json_encode(['tareas' => $tareas]);
    }

    public static function crear()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {

            $proyectoId = $_POST['proyectoId'];
            $proyecto = Proyecto::where('url', $proyectoId);

            // Validar que el usuario que envía la petición para añadir la tarea
            // es el propietario del proyecto 
            if (!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => "Ha habido un problema al agregar la tarea"
                ];
                echo json_encode($respuesta);
                return;
            }

            // Todo ha ido bien, instanciar y crear la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => "Tarea agregada correctamente"
            ];
            echo json_encode($respuesta);
        }
    }

    public static function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }
    }

    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }
    }
}
