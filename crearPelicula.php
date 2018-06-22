<!DOCTYPE html>

<html>
  <head>
    <title>Crear</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Laboratorio N°7</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="directores.php">Directores</a></li>
        </ul>
      </div>
    </nav> 
    <div class="container">
      <?php
        require_once('baseDeDatos.php');
        $equipos = new BD;
        $equipos->conectar();
        $equipos->crearPelicula();
      ?>
    </div>
  </body>
</html>