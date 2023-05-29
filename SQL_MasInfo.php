<html>
    <link rel="icon" type="image/x-icon" href="/imagenes/pokeball.png">
    <link rel="stylesheet" href="EstiloMasInfo.css">
    <body>
<?php
//echo "conectando a database";
//$mysqli = mysqli_connect("192.168.1.122", "user1", "contrasena", "pokemon1");
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
//echo "conectado a database";
if (!$mysqli) {
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
} 
//echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;

$nombre = ($_GET['nombre']);
$sql = "SELECT p.*, eb.*, t.*, ed.* FROM pokemon p
		LEFT JOIN estadisticas_base eb ON p.numero_pokedex = eb.numero_pokedex 
		LEFT JOIN pokemon_tipo pt ON p.numero_pokedex  = pt.numero_pokedex LEFT JOIN tipo t on pt.id_tipo = t.id_tipo 
		LEFT JOIN evoluciona_de ed ON p.nombre = ed.pokemon_origen
		WHERE p.nombre = '$nombre'";
$result = mysqli_query($mysqli, $sql);
//$result_mov = mysqli_query($mysqli, $sql_mov);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}else{
	    echo "Query Ok \n";
		
	    while ($row = mysqli_fetch_assoc($result)) {
			echo"<table class='card'>";
			echo"<div>";
			echo"<tr>";
			if($row['numero_pokedex'] < 10){
				echo"<td colspan='2'><img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/00"."$row[numero_pokedex]".".png'></td></tr>";
			}else if($row['numero_pokedex'] < 100){
				echo"<td colspan='2'><img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/0"."$row[numero_pokedex]".".png'></td></tr>";
			}else{
				echo"<td colspan='2'><img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/"."$row[numero_pokedex]".".png'></td></tr>";
			}
			echo"</tr>";


			echo"<tr>";
			echo"<td>Numero Pokedex:</td>";
			echo"<td>".$row['numero_pokedex']."</td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td id='nombre' >Nombre:</td>";
			echo"<td>".$nombre."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Altura:</td>";
			echo"<td>".$row['altura']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Peso:</td>";
			echo"<td>".$row['peso']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>PS:</td>";
			echo"<td>".$row['ps']."</td>";

			echo"<tr>";
			echo"<td>Ataque:</td>";
			echo"<td>".$row['ataque']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Defensa:</td>";
			echo"<td>".$row['defensa']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Ataque Especial:</td>";
			echo"<td>".$row['especial']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Velocidad:</td>";
			echo"<td>".$row['velocidad']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Tipo:</td>";
			echo"<td>".$row['nombre']."</td>";
			echo"</tr>";

			echo"<tr>";
			include 'MasInfo_Mov.php';
			echo"</tr>";


			echo"</div>";
			echo"</table>";

		}
	} 
    mysqli_close($mysqli);
?>
<td><input id="volver" type="button" value="Volver"  onclick="location.href='index.php'" ></td>
</body>
</html>
