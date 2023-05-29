<html>
    <script>
        function redireccionar(){
            window.location.href ="SQL_consultarPokemon2.php"
        }
    </script>
<link rel="icon" type="image/x-icon" href="/imagenes/pokeball.png">
	<link rel="stylesheet" href="EstiloFormularioInsertar.css">

	<body>
<?php
echo "conectando a database";
//$mysqli = mysqli_connect("192.168.1.122", "user1", "contrasena", "pokemon1");
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
echo "conectado a database";
if (!$mysqli) {  
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
}
    
echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($mysqli) . PHP_EOL;
$nombre = $_POST['nombre'];
echo $nombre;
$sql = 'DELETE FROM pokemon WHERE nombre = "'.$nombre.'"';
echo $sql;
$result = mysqli_query($mysqli, $sql);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}else{
    echo $sql;
    mysqli_query($mysqli, $sql);
    echo "<button onclick='redireccionar()'>Ver cambios</button>";
}
    mysqli_close($mysqli);
?>

<td><input id="volver" type="button" value="Volver" onclick="location.href='index.php'" ></td>
</body>
</html>