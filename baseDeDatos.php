<?php
  //3 Clase que maneja la conexion a la base de datos, asi como las operaciones de entrada y salida.
	class BD
	{
		private $conn, $result;

  		function conectar(){
  			$hn = 'localhost';
  			$db = 'bddirectores';
  			$un = 'root';
  			$pw = '';
  			$this->conn = mysqli_connect($hn, $un, $pw, $db);
  			if ($this->conn->connect_error) die($this->conn->connect_error);
  		}

      //3.a) Listar elementos de A
  		function leer_directores(){
  			$query  = "SELECT * FROM director";
  			$this->result = $this->conn->query($query);
  			if (!$this->result) die($this->conn->error);
				echo '<a href="crearDirector.php" class="btn btn-info" style="margin-bottom: 10px;float: right;" role="button">Crear Director</a>';
				echo '<table class="table">';
        echo '<tr><th>ID</th>';
				echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';				
        echo '<th>Pais</th>';
        echo '<th>Edad</th>';
				echo '<th>Productora</th>';
				echo '<th>Acción 1</th>';
        echo '<th>Acción 2</th>';
        echo '<th>Acción 3</th></tr>';
  			$rows = $this->result->num_rows;
  			for ($j = 0 ; $j < $rows ; ++$j)
  			{
    			$this->result->data_seek($j);
    			$row = $this->result->fetch_array(MYSQLI_ASSOC);
    			echo '<tr><td>' . $row['idDirector'] . '</td>';
					echo '<td>' . $row['nombre'] . '</td>';
					echo '<td>' . $row['apellido'] . '</td>';					
    			echo '<td>' . $row['pais'] . '</td>';
					echo '<td>' . $row['edad'] . '</td>';
					echo '<td>' . $row['productora'] . '</td>';
					echo '<td><a href="verPeliculas.php?p1='.$row['idDirector'] .'">Ver películas</a></td>';
					echo '<td><a href="editarDirector.php?p1='.$row['idDirector'] .'">Editar</a></td>';
					echo '<td><a href="eliminarDirector.php?p1='.$row['idDirector'] .'">Eliminar</a></td></tr>';								
  			}
        echo '</table>';
			}
			//3.b) Crear elemento de A mediante formulario
			function crearDirector(){
				echo '<form action="crearDirector.php" method="post">
								<div class="form-group">
									<label for="name">Nombre:</label>
									<input type="text" class="form-control" name="name">
								</div>
								<div class="form-group">
									<label for="second">Apellido:</label>
									<input type="text" class="form-control" name="second">
								</div>
								<div class="form-group">
									<label for="country">Pais:</label>
									<input type="text" class="form-control" name="country">
								</div>
								<div class="form-group">
									<label for="old">Edad:</label>
									<input type="text" class="form-control" name="old">
								</div>
								<div class="form-group">
									<label for="prod">Productora:</label>
									<input type="text" class="form-control" name="prod">
								</div>
								<button type="submit" class="btn btn-success">Crear</button>
								<a href="directores.php" class="btn btn-default" role="button">Volver</a>';
				if (isset($_POST['name']) && is_numeric($_POST['old'])){
					$query = "SELECT * FROM director";
					$this->result = $this->conn->query($query);
					if (!$this->result) die($this->conn->error);
					$rows = $this->result->num_rows + 1;
					$nombre = BD::get_post($this->conn,'name');
					$apellido = BD::get_post($this->conn,'second');
					$pais = BD::get_post($this->conn,'country');
					$edad = BD::get_post($this->conn,'old');
					$productora = BD::get_post($this->conn,'prod');
					$query_temp =  "INSERT INTO director VALUES ('$rows', '$nombre', '$apellido', '$pais', '$edad', '$productora')";
					$this->result = $this->conn->query($query_temp);

					if(!$this->result){
						echo "INSERT error : $query_temp<br>";
						$this-> conn->error;
					}
					else{
						echo '<div class="alert alert-success" style="padding: 10px;">
                    <strong>Creación Exitosa!</strong>
                  </div>';
					}
				}
			}
			//3.c) Modificar elemento de A mediante formulario
			function editarDirector(){
				$id = $_GET["p1"];
				$query  = "SELECT * FROM director WHERE idDirector='$id'";
				$this->result = $this->conn->query($query);
				if(!$this->result){ 
					echo "SELECT falló: $query<br>";
					$this->conn->error . "<br><br>";
				}
				$director_temp = $this->result->fetch_array(MYSQLI_ASSOC);
				echo '<form action="editarDirector.php?p1='.$id.'" method="post">
								<div class="form-group">
									<label for="name">Nombre:</label>
									<input type="text" class="form-control" name="name" value="'.$director_temp['nombre'].'">
								</div>
								<div class="form-group">
									<label for="second">Apellido:</label>
									<input type="text" class="form-control" name="second" value="'.$director_temp['apellido'].'">
								</div>
								<div class="form-group">
									<label for="country">Pais:</label>
									<input type="text" class="form-control" name="country" value="'.$director_temp['pais'].'">
								</div>
								<div class="form-group">
									<label for="old">Edad:</label>
									<input type="text" class="form-control" name="old" value="'.$director_temp['edad'].'">
								</div>
								<div class="form-group">
									<label for="prod">Productora:</label>
									<input type="text" class="form-control" name="prod" value="'.$director_temp['productora'].'">
								</div>
							<button type="submit" class="btn btn-success">Modificar</button>
							<a href="directores.php" class="btn btn-default" role="button">Volver</a>';
				if (isset($_POST['name']) && is_numeric($_POST['old'])){
					$nombre = BD::get_post($this->conn,'name');
					$apellido = BD::get_post($this->conn,'second');
					$pais = BD::get_post($this->conn,'country');
					$edad = BD::get_post($this->conn,'old');
					$productora = BD::get_post($this->conn,'prod');
					$query_temp =  "UPDATE director SET idDirector='$id', nombre='$nombre', apellido='$apellido', pais='$pais', edad='$edad', productora='$productora' WHERE idDirector='$id'";
					$this->result = $this->conn->query($query_temp);
					if(!$this->result){
						echo "UPDATE error : $query_temp<br>";
						$this-> conn->error;
					}
					else{
						echo '<div class="alert alert-success" style="padding: 10px;">
                    <strong>Modificación Exitosa!</strong>
                  </div>';
					}
				}
			}
			//3.d) Eliminar elemento A
			function eliminarDirector(){
				$id = $_GET["p1"];
				$query  = "DELETE FROM director WHERE idDirector='$id'";
				$this->result = $this->conn->query($query);
				if (!$this->result){
					echo "DELETE failed: $query<br>" .
					$this->conn->error . "<br><br>";
				}
				else{
					echo '<div class="alert alert-success">
						<strong>Eliminación Exitosa!</strong>
						</div>';
				}
				echo '<a href="directores.php" class="btn btn-default" role="button">Volver</a>';
			}
			//3.e) Ver elemento A con lista de hijos B
			function verPeliculas(){
				$id = $_GET["p1"];
				$query  = "SELECT * FROM director WHERE idDirector='$id'";
				$this->result = $this->conn->query($query);
				if(!$this->result){ 
					echo "SELECT falló: $query<br>";
					$this->conn->error . "<br><br>";
				}
				$director_temp = $this->result->fetch_array(MYSQLI_ASSOC);
				echo '<div class="panel panel-default">
								<div class="panel-heading">Filmografía</div>
								<div class="panel-body">Nombre: '.$director_temp['nombre'].'<br>Apellido: '.$director_temp['apellido'].'<br>Pais: '.$director_temp['pais'].'<br>Edad: '.$director_temp['edad'].'<br>Productora:'.$director_temp['productora'].'</div>
							</div>';
				$query_temp = "SELECT * FROM pelicula";
				$this->result = $this->conn->query($query_temp);
				if (!$this->result) die($this->conn->error);
				$rows = $this->result->num_rows;
				echo '<a href="crearPelicula.php?p1='.$id.'" class="btn btn-info" style="margin-bottom: 10px;float: right;" role="button">Crear película</a>';
				echo'	<h3>Películas</h3>
								<table class="table">
								<tr>
									<th>idPelicula</th>
									<th>Titulo</th>
									<th>Duracion</th>
									<th>Idioma</th>
									<th>Estreno</th>
								</tr>';
					for ($j = 0 ; $j < $rows ; ++$j){
						$this->result->data_seek($j);
						$row = $this->result->fetch_array(MYSQLI_ASSOC);
						if($row['Director_idDirector'] == $id){
							echo '<tr><td>' . $row['idPelicula'] . '</td>';
							echo '<td>' . $row['titulo'] . '</td>';
							echo '<td>' . $row['duracion'] . '</td>';
							echo '<td>' . $row['idioma'] . '</td>';
							echo '<td>' . $row['estreno'] . '</td></tr>';
						}
					}
					echo '</table>';
					echo '<a href="directores.php" class="btn btn-default" role="button">Volver</a>';
				
			}
			//3.f) Crear hijo B mediante formulario
			function crearPelicula(){
				$id = $_GET["p1"];
				echo '<form action="crearPelicula.php?p1='.$id.'" method="post">
								<div class="form-group">
									<label for="name">Título:</label>
									<input type="text" class="form-control" name="title">
								</div>
								<div class="form-group">
									<label for="second">Duración:</label>
									<input type="text" class="form-control" name="duration">
								</div>
								<div class="form-group">
									<label for="country">Idioma:</label>
									<input type="text" class="form-control" name="lang">
								</div>
								<div class="form-group">
									<label for="old">Estreno:</label>
									<input type="text" class="form-control" name="avl">
								</div>
								<button type="submit" class="btn btn-success">Crear</button>
								<a href="verPeliculas.php?p1='.$id.'" class="btn btn-default" role="button">Volver</a>';
				if (isset($_POST['title']) && is_numeric($_POST['duration'])){
					$query = "SELECT * FROM pelicula";
					$this->result = $this->conn->query($query);
					if (!$this->result) die($this->conn->error);
					$rows = $this->result->num_rows + 1;
					$titulo = BD::get_post($this->conn,'title');
					$duracion = BD::get_post($this->conn,'duration');
					$idioma = BD::get_post($this->conn,'lang');
					$estreno = BD::get_post($this->conn,'avl');
					$query_temp =  "INSERT INTO pelicula VALUES ('$rows', '$titulo', '$duracion', '$idioma', '$estreno', '$id')";
					$this->result = $this->conn->query($query_temp);
				
					if(!$this->result){
						echo "INSERT error : $query_temp<br>";
						$this-> conn->error;
					}
					else{
						echo '<div class="alert alert-success" style="padding: 10px;">
										<strong>Creación Exitosa!</strong>
									</div>';
					}
				}
			}
			function close(){
  			$this->result->close();
  			$this->conn->close();
			}
			function get_post($conn, $var)
      {
        return $conn->real_escape_string($_POST[$var]);
      }
	}
?>