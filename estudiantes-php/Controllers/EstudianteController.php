<?php
declare(strict_types=1);

require_once __DIR__ . '/../model/Estudiante.php';

class EstudianteController
{
    private static array $estudiantes = [];
    private static string $archivo = __DIR__ . '/../estudiantes.json';

    public static function iniciar(): void
    {
        self::$estudiantes = [];

        $estudiante1 = new Estudiante('Anuar', 'Vargas', 20, '106624424', 'Ingenieria de Sistemas');
        self::$estudiantes[$estudiante1->getCodigo()] = $estudiante1;

        if (file_exists(self::$archivo)) {
            $lista = json_decode(file_get_contents(self::$archivo), true);

            if (is_array($lista)) {
                foreach ($lista as $dato) {
                    $est = new Estudiante(
                        $dato['nombre'],
                        $dato['apellido'],
                        (int)$dato['edad'],
                        (string)$dato['codigo'],
                        $dato['carrera']
                    );
                    if (!isset(self::$estudiantes[$est->getCodigo()])) {
                        self::$estudiantes[$est->getCodigo()] = $est;
                    }
                }
            }
        }
    }

    private static function guardar(): void
    {
        $lista = [];
        foreach (self::$estudiantes as $est) {
            $lista[] = $est->obtenerDatos();
        }
        file_put_contents(self::$archivo, json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public static function responder(int $codigoHttp, array $respuesta): void
    {
        http_response_code($codigoHttp);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function getEstudiantes(): void
    {
        if (isset($_GET['codigo'])) {
            $codigo = (string)$_GET['codigo'];

            if (isset(self::$estudiantes[$codigo])) {
                self::responder(200, self::$estudiantes[$codigo]->obtenerDatos());
            } else {
                self::responder(404, ['mensaje' => 'No existe un estudiante con el codigo: ' . $codigo]);
            }
            return;
        }

        $lista = [];
        foreach (self::$estudiantes as $est) {
            $lista[] = $est->obtenerDatos();
        }
        self::responder(200, $lista);
    }

    private static function leerCampo(array $datos, string $campo): string
    {
        if (isset($datos[$campo]) && is_scalar($datos[$campo])) {
            return trim((string)$datos[$campo]);
        }
        return '';
    }

    public static function registrarEstudiante(): void
    {
        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            $datos = $_POST;
        }

        $nombre = self::leerCampo($datos, 'nombre');
        $apellido = self::leerCampo($datos, 'apellido');
        $edad = self::leerCampo($datos, 'edad');
        $codigo = self::leerCampo($datos, 'codigo');
        $carrera = self::leerCampo($datos, 'carrera');

        if ($nombre === '' || $apellido === '' || $edad === '' || $codigo === '' || $carrera === '') {
            self::responder(400, ['mensaje' => 'Todos los campos son obligatorios']);
            return;
        }

        if (!ctype_digit($edad) || (int)$edad < 1 || (int)$edad > 120) {
            self::responder(400, ['mensaje' => 'La edad debe ser un numero entre 1 y 120']);
            return;
        }

        if (isset(self::$estudiantes[$codigo])) {
            self::responder(409, ['mensaje' => 'Ya existe un estudiante con el codigo: ' . $codigo]);
            return;
        }

        $est = new Estudiante($nombre, $apellido, (int)$edad, $codigo, $carrera);
        self::$estudiantes[$codigo] = $est;
        self::guardar();

        self::responder(200, ['mensaje' => 'El estudiante se creo correctamente: ' . $codigo]);
    }
}
