<html>
	<link rel="icon" type="image/x-icon" href="/imagenes/pokeball.png">
	<link rel="stylesheet" href="EstiloFormularioInsertar.css">
	<body>
<?php
//echo "conectando a database";
//$mysqli = mysqli_connect("192.168.1.122", "user1", "contrasena", "pokemon1");
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
//echo "conectado a database";
if (!$mysqli) {
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
}
    
//echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
//echo "Información del host: " . mysqli_get_host_info($mysqli) . PHP_EOL;
$num_pokedex = $_POST['num_pokedex'];
$nombre = $_POST['nombre'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];

$sql = 'INSERT INTO pokemon (numero_pokedex, nombre, peso, altura) VALUES ('.$num_pokedex.', "'.$nombre.'", '.$peso.', '.$altura.')';
echo $sql;

if (!$num_pokedex) {
	echo 'Por favor, introduzca un numero de pokedex valido';
	echo '<input id="volver" type="button" value="Volver" onclick="location.href="FormularioInsertar.html"">';
	exit;
}
if (!$nombre) {
	echo 'Por favor, introduzca un nombre';
	echo '<input id="volver" type	="button" value="Volver" onclick="location.href="FormularioInsertar.html"">';
	exit;
}
if (!$peso) {
	echo 'Por favor, introduzca un peso';
	echo '<input id="volver" type	="button" value="Volver" onclick="location.href="FormularioInsertar.html"">';
	exit;
}
if (!$altura) {
	echo 'Por favor, introduzca una altura';
	echo '<input id="volver" type	="button" value="Volver" onclick="location.href="FormularioInsertar.html"">';
	exit;
}

$result = mysqli_query($mysqli, $sql);
//include 'Trigger.php';
if(!$result) {
	die('Invalid query: ' . mysql_error());
}else{
	echo "<div>Pokemon creado correctamente \n";
	echo '<input id="Ver" type="button" value="Ver Pokemon" onclick="location.href="MasInfo.php?nombre='.$nombre.'">';
}
mysqli_close($mysqli);
?>

<td><input id="volver" type="button" value="Volver" onclick="location.href='index.php'" ></td>
</body>
</html>