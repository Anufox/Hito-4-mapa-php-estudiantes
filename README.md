# Estudiantes con mapas y herencia Con PHP 
## Descripcion
PHP Q registra y consulta estudiantes con peticiones GET y POST esto usa:
- Herencia: Estudiante hereda de Persona.
- Encapsulamiento: "atributos protected" con getters y setters.
- Tipos estrictos: "declare(strict_types=1)"; y tipos en propiedades, parametros y retornos.
- Mapa:"EstudianteController" guarda los estudiantes en un arreglo y no deja repetir codigos.
  
posdata se me bugueo el git hub al enviar poreso lo mande asi

El estudiante inicial osea el mio tiene mi nombre solo para ejecutar.
## Estructura
```
estudiantes-php/
  index.php
  estudiantes.php
  estudiantes.json   (se crea solo al registrar)
  model/
    Persona.php
    Estudiante.php
  Controllers/
    EstudianteController.php
## Formulario web
Entrar a `http://localhost/estudiantes-php/`, llenar los campos y presionar "Registrar". El navegador muestra la respuesta en JSON. El enlace "Ver estudiantes" muestra la lista.
