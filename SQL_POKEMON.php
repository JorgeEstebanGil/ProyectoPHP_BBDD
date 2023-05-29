<html>
	<link rel="icon" type="image/x-icon" href="/imagenes/pokeball.png">
	<link rel="stylesheet" href="EstiloConsultaPHP.css">
	<body>
		
<?php
echo "conectando a database";
//$mysqli = mysqli_connect("192.168.1.122", "user1", "contrasena", "pokemon1");
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
echo "conectado a database";
if (!$mysqli) {
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
    }
    
    echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($mysqli) . PHP_EOL;
/*Obtener el valor del boton que hemos apretad para acceder a esta pagina a través del boton info de SQL_consultarPokemon.php*/
$nombre = $_POST['info'];
$data = mysqli_fetch_array($result);
$i = 0;
$sql_main = 'SELECT p.* FROM pokemon p, estadisticas_base eb, pokemon_tipo pt, tipo t WHERE p.numero_pokedex = eb.numero_pokedex AND p.numero_pokedex = pt.numero_pokedex AND pt.id_tipo = t.id_tipo';
$sql_name = ' AND p.nombre="$nombre"';
$sql_end = ' ORDER BY p.numero_pokedex ASC';
$sql = $sql_main.$sql_name.$sql_end;
$result = mysqli_query($mysqli, $sql);
echo "<h1>$nombre</h1>";
if (!$result) {
    die('Invalid query: ' . mysql_error());
}else{
	    echo "query ok \n";
	    // iterate over all rows
		;
	    while ($row = mysqli_fetch_assoc($result)) {
	        
			echo"<div class='card'>";
			echo"<img src='imagenes/".$row['numero_pokedex'].".png' alt='Avatar' style='width:100%'>";
			echo"<div class='container'>";
			echo"<h4><b>".$row['nombre']."</b></h4>";
			echo"<p>Numero Pokedex: ".$row['numero_pokedex']."</p>";
			echo"<p>Altura: ".$row['altura']."</p>";
			echo"<p>Peso: ".$row['peso']."</p>";
			echo"<p>Descripcion: ".$row['descripcion']."</p>";
			echo"<p>PS: ".$row['ps']."</p>";
			echo"<p>Ataque: ".$row['ataque']."</p>";
			echo"<p>Defensa: ".$row['defensa']."</p>";
			echo"<p>Ataque Especial: ".$row['ataque_especial']."</p>";
			echo"<p>Defensa Especial: ".$row['defensa_especial']."</p>";
			echo"<p>Velocidad: ".$row['velocidad']."</p>";
	        
			
		}
	} 
    mysqli_close($mysqli);
?>

<td><input id="volver" type="button" value="Volver" onclick="location.href='index.php'" ></td>
</body>
</html>