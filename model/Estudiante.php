<?php
declare(strict_types=1);

require_once __DIR__ . '/Persona.php';

class Estudiante extends Persona
{
    protected string $codigo;
    protected string $carrera;

    public function __construct(string $nombre, string $apellido, int $edad, string $codigo, string $carrera)
    {
        parent::__construct($nombre, $apellido, $edad);
        $this->codigo = $codigo;
        $this->carrera = $carrera;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getCarrera(): string
    {
        return $this->carrera;
    }

    public function setCarrera(string $carrera): void
    {
        $this->carrera = $carrera;
    }

    public function obtenerDatos(): array
    {
        return [
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'edad' => $this->edad,
            'codigo' => $this->codigo,
            'carrera' => $this->carrera
        ];
    }
}
