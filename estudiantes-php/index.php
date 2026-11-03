<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registro de estudiantes</title>
</head>
<body>
<h1>Registrar estudiante</h1>

<form method="post" action="estudiantes.php">
  <p>Codigo: <input type="text" name="codigo"></p>
  <p>Nombre: <input type="text" name="nombre"></p>
  <p>Apellido: <input type="text" name="apellido"></p>
  <p>Edad: <input type="number" name="edad"></p>
  <p>Carrera: <input type="text" name="carrera"></p>
  <p><button type="submit">Registrar</button></p>
</form>

<p><a href="estudiantes.php">Ver estudiantes</a></p>
</body>
</html>
