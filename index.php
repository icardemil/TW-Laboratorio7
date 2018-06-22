<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="directores.php">Directores</a></li>
        </ul>
      </div>
    </nav> 
    <div class="container">
      <?php
        echo "<h3>Bienvenido</h3><br>
              Autores:<br>
              Iván Cardemil<br>
              Kevin Marca<br>
              Laboratorio N°7 - Tecnologia Web<br>
              PHP";
      ?>
    </div>
</body>
</html>