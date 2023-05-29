<html>
	<link rel="icon" type="image/x-icon" href="/imagenes/pokeball.png">
	<link rel="stylesheet" href="EstiloConsultaPHP.css">
	<script>
		//Funcion que muestra el popup defindo al final del documento
		function mostrarPopup(){
			var popup = document.getElementById("popup");
			popup.classList.toggle("show");
		}
	

		//Funcion que cierra el popup al hacer click en la X
		function cerrarPopup(){
			var popup = document.getElementById("popup");
			popup.classList.toggle("show");
		}
	</script>
	
	<body>
	<!-- Añadir desplegables con cada parametro de las tarjetas -->
	<div class="container">
		<h1>Consulta de Pokemon</h1>
		<form action="SQL_consultarPokemon.php" method="post">
			<label for="ps">PS:</label>
			<input type="text" id="ps" name="ps" placeholder="Puntos de Salud..">
			<input type="submit" value="Buscar" action>
			<form id="filtro" action="SQL_consultarPokemon2.php" method="post">
			<label for="NumeroPokedex">Numero Pokedex:</label>
			<input type="text" id="NumeroPokedex" name="NumeroPokedex" placeholder="Numero Pokedex..">
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="nombre" placeholder="Nombre del pokemon..">
			<label for="tipo">Tipo:</label>
			<select id="tipo" name="tipo">
				<option value="">--</option>
				<option value="Acero">Acero</option>
				<option value="Agua">Agua</option>
				<option value="Bicho">Bicho</option>
				<option value="Dragon">Dragon</option>
				<option value="Electrico">Electrico</option>
				<option value="Fantasma">Fantasma</option>
				<option value="Fuego">Fuego</option>
				<option value="Hada">Hada</option>
				<option value="Hielo">Hielo</option>
				<option value="Lucha">Lucha</option>
				<option value="Normal">Normal</option>
				<option value="Planta">Planta</option>
				<option value="Psiquico">Psiquico</option>
				<option value="Roca">Roca</option>
				<option value="Siniestro">Siniestro</option>
				<option value="Tierra">Tierra</option>
				<option value="Veneno">Veneno</option>
				<option value="Volador">Volador</option>
			</select>

			<label for="maxataque">Ataque:</label>
			<input type="text" id="maxataque" name="maxataque" placeholder="Maximo ataque..">
			<input type="text" id="minataque" name="minataque" placeholder="Minimo ataque..">

			<label for="maxdefensa">Defensa:</label>
			<input type="text" id="maxdefensa" name="maxdefensa" placeholder="Maximo defensa..">
			<input type="text" id="mindefensa" name="mindefensa" placeholder="Minimo defensa..">

			<label for="maxvelocidad">Velocidad:</label>
			<input type="text" id="maxvelocidad" name="maxvelocidad" placeholder="Maximo velocidad..">
			<input type="text" id="minvelocidad" name="minvelocidad" placeholder="Minimo velocidad..">

			<label for="maxPS">PS:</label>
			<input type="text" id="maxPS" name="maxPS" placeholder="Maximo PS..">
			<input type="text" id="minPS" name="minPS" placeholder="Minimo PS..">
			</select>

			<label for="orden">Ordenar por:</label>
			<select id="orden" name="orden">
				<option value="">--</option>
				<option value="p.nombre ASC">Nombre Ascendente</option>
				<option value="p.nombre DESC">Nombre Descendente</option>
				<option value="p.numero_pokedex ASC">Numero Pokedex Ascendente</option>
				<option value="p.numero_pokedex DESC">Numero Pokedex Descendente</option>
				<option value="p.altura ASC">Altura Ascendente</option>
				<option value="p.altura DESC">Altura Descendente</option>
				<option value="p.peso ASC">Peso Ascendente</option>
				<option value="p.peso DESC">Peso Descendente</option>
				<option value="eb.ps ASC">PS Ascendente</option>
				<option value="eb.ps DESC">PS Descendente</option>
				<option value="eb.ataque ASC">Ataque Ascendente</option>
				<option value="eb.ataque DESC">Ataque Descendente</option>
				<option value="eb.defensa ASC">Defensa Ascendente</option>
				<option value="eb.defensa DESC">Defensa Descendente</option>
				<option value="eb.velocidad ASC">Velocidad Ascendente</option>
				<option value="eb.velocidad DESC">Velocidad Descendente</option>
			</select>

			<input type="submit" value="Buscar">

		</form>
		</form>
		<!..
	</div>
<?php
echo "Conectando a database";
//$mysqli = mysqli_connect("192.168.1.122", "user1", "contrasena", "pokemon1");
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
echo "Conectado a database";
if (!$mysqli) {
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
}
	
echo "Éxito: Se realizó una conexión apropiada a MySQL!" . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($mysqli) . PHP_EOL;
echo "<br>";
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$ps = $_POST['ps'];


$i = 0;
$sql_main = 'SELECT p.* FROM pokemon p';
$sql_conn = ' LEFT JOIN estadisticas_base eb ON p.numero_pokedex = eb.numero_pokedex LEFT JOIN pokemon_tipo pt ON p.numero_pokedex  = pt.numero_pokedex LEFT JOIN tipo t on pt.id_tipo = t.id_tipo  ';
$sql_end = ' ORDER BY p.numero_pokedex ASC';
$sql_name = ' AND p.nombre like "%'.$nombre.'%"';
$sql_tipo = ' AND t.nombre="'.$tipo.'"';
$sql_ps = ' AND eb.ps = "'.$ps.'"';
//Concatenar los string anteriores
$sql = $sql_main.$sql_conn;
if ($nombre) {
	$sql = $sql.$sql_name;
}
if ($tipo) {
	$sql = $sql.$sql_tipo;
}
if ($ps) {
	$sql = $sql.$sql_ps;
}
$sql = $sql.$sql_end;
$data = array("Numero Pokedex", "Nombre", "Peso", "Altura");
$result = mysqli_query($mysqli, $sql);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}else{
	    echo "Query OK \n";
	    // iterate over all rows
		
	    while ($row = mysqli_fetch_assoc($result)) {
			echo"<div class='card'>";
			echo"<div class='container'>";
			if($row['numero_pokedex'] < 10){
				echo"<td><img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/00"."$row[numero_pokedex]".".png'></td></tr>";
			}else if($row['numero_pokedex'] < 100){
				echo"<td><img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/0"."$row[numero_pokedex]".".png'></td></tr>";
			}else{
				echo"<td><img src='https://assets.pokemon.com/assets/cms2/img/pokedex/detail/"."$row[numero_pokedex]".".png'></td></tr>";
			}
	        // iterate over all columns
	        foreach ($row as $col) {
				echo "<p><b>$data[$i]:</b> ";
				echo "$col<p>";
				$i++;
	        }
			$i=0;
			/*Boton que nos lleve a la página SQL_MasInfo.php*/
			echo '<input type="button" onclick="location=?gestionPersonas.php"" value="MasInfo"></div></div>';
		
	
		}
	} 
    mysqli_close($mysqli);
	echo $popup;
?>

<td><input id="volver" type="button" value="Volver"  onclick="location.href='index.php'" ></td>
<!--Crear ventana popup-->
<div id="popup" class="overlay">
	<div class="popup">
		<h2>Informacion Adicional</h2>
		<a class="close" onclick="cerrarPopup()">&times;</a>
		<div class="content">
			Prueba
		</div>
	</div>
</div>

</body>
</html>


