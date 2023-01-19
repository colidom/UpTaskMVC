<?php

namespace Controllers;

use Model\Proyecto;

class TareaController
{
    public static function index()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        }
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
            } else {
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => "Tarea agregada correctamente"
                ];
            }
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
