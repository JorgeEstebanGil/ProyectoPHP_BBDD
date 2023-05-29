<?php
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
if (!$mysqli) {
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
} 
$nombre = ($_GET['nombre']);

$sql_mov = "SELECT m.* FROM pokemon p, movimiento m, pokemon_movimiento_forma pmf WHERE p.numero_pokedex = pmf.numero_pokedex AND pmf.id_movimiento = m.id_movimiento AND p.nombre = '$nombre'";
echo 'nombre:'.$nombre;
$result_mov = mysqli_query($mysqli, $sql_mov);
if (!$result_mov) {
    die('Invalid query: ' . mysql_error());
}else{
        echo "Query Ok \n";
        
        while ($row = mysqli_fetch_assoc($result_mov)) {
            
            echo"<tr>";
            echo"<td>Movimiento:</td>";
            echo"<td text-align='center'>".$row['nombre']."</td>";
            echo"<td>";
            

        }
}
mysqli_close($mysqli);
?>