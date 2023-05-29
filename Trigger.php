<!-- PHP que cntengas un funcion que elimine un movimiento que ha recibido por get-->
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

$sql_numero_pokedex = "SELECT numero_pokedex FROM pokemon WHERE nombre = '$_GET[nombre]'";
$sql1 = 'CREATE TRIGGER rellenar AFTER INSERT ON estadisticas_base
        FOR EACH ROW
        BEGIN
            UPDATE estadisticas_base
            SET ps = RAND() * 250, ataque = RAND() * 250, defensa = RAND() * 250, velocidad = RAND() * 250
            WHERE numero_pokedex = $sql_numero_pokedex;
        END;';

$result = mysqli_query($mysqli, $sql);

if(!$result) {
    die('Invalid query: ' . mysql_error());
}else{
        echo "Query Ok \n";
}
mysqli_close($mysqli);
?>  




