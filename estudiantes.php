<?php
declare(strict_types=1);

require_once __DIR__ . '/Controllers/EstudianteController.php';

header('Content-Type: application/json; charset=utf-8');

EstudianteController::iniciar();

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {
    EstudianteController::getEstudiantes();
} elseif ($metodo === 'POST') {
    EstudianteController::registrarEstudiante();
} else {
    EstudianteController::responder(405, ['mensaje' => 'Metodo no permitido']);
}
