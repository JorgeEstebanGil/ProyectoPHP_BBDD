<html>
	<link rel="icon" type="image/x-icon" href="/imagenes/pokeball.png">
	<link rel="stylesheet" href="EstiloConsultaPHP2.css">
	<script>
		function redireccionar(){
			window.location.href = "SQL_MasInfo.php?nombre=<?php echo $nombre ?>";
		}
	</script>
	
	<body>
	<!-- Añadir desplegables con cada parametro de las tarjetas -->
	<div class="container">
		<h1>Consulta de Pokemon</h1>
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

			<label for="maxaltura">Altura:</label>
			<input type="text" id="minAltura" name="minAltura" placeholder="Minima altura..">
			<input type="text" id="maxAltura" name="maxAltura" placeholder="Maxima altura..">

			<label for="maxpeso">Peso:</label>
			<input type="text" id="minPeso" name="minPeso" placeholder="Minimo peso..">
			<input type="text" id="maxPeso" name="maxPeso" placeholder="Maximo peso..">

			<label for="maxPS">PS:</label>
			<input type="text" id="minPS" name="minPS" placeholder="Minimo PS..">
			<input type="text" id="maxPS" name="maxPS" placeholder="Maximo PS..">

			<label for="maxataque">Ataque:</label>
			<input type="text" id="minAtaque" name="minAtaque" placeholder="Minimo ataque..">
			<input type="text" id="maxAtaque" name="maxAtaque" placeholder="Maximo ataque..">

			<label for="maxdefensa">Defensa:</label>
			<input type="text" id="minDefensa" name="minDefensa" placeholder="Minima defensa..">
			<input type="text" id="maxDefensa" name="maxDefensa" placeholder="Maxima defensa..">

			<label for="maxvelocidad">Velocidad:</label>
			<input type="text" id="minVelocidad" name="minVelocidad" placeholder="Minima velocidad..">
			<input type="text" id="maxVelocidad" name="maxVelocidad" placeholder="Maxima velocidad..">

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
	</div>

<?php
//$mysqli = mysqli_connect("192.168.1.122", "user1", "contrasena", "pokemon1");
$mysqli = mysqli_connect("172.17.0.2", "root", "mysql01", "pokemondb");
//echo "Conectado a database ";
if (!$mysqli) {
	echo "Error: No se pudo conectar a MySQL. \n" . PHP_EOL;
	echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
	exit;
}
	
//echo "Éxito: Se realizó una conexión apropiada a MySQL! " . PHP_EOL;
//echo "Información del host: " . mysqli_get_host_info($mysqli) . PHP_EOL;

//Recoger los datos del formulario
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$maxPS = $_POST['maxPS'];
$minPS = $_POST['minPS'];
$maxaltura = $_POST['maxAltura'];
$minaltura = $_POST['minAltura'];
$maxpeso = $_POST['maxPeso'];
$minpeso = $_POST['minPeso'];
$numero_pokedex = $_POST['numero_pokedex'];
$maxataque = $_POST['maxAtaque'];
$minataque = $_POST['minAtaque'];
$maxdefensa = $_POST['maxDefensa'];
$mindefensa = $_POST['minDefensa'];
$maxvelocidad = $_POST['maxVelocidad'];
$minvelocidad = $_POST['minVelocidad'];
$aux = $_POST['orden'];
$order = ' ORDER BY '.$aux;

//String de la consulta
$sql_main = 'SELECT p.* FROM pokemon p';
$sql_conn = ' LEFT JOIN estadisticas_base eb ON p.numero_pokedex = eb.numero_pokedex LEFT JOIN pokemon_tipo pt ON p.numero_pokedex  = pt.numero_pokedex LEFT JOIN tipo t on pt.id_tipo = t.id_tipo  ';
$sql_name = ' WHERE p.nombre like "%'.$nombre.'%"';
$sql_tipo = ' AND t.nombre="'.$tipo.'"';
$sql_psMIN = ' AND eb.ps >= '.$minps;
$sql_psMAX = ' AND eb.ps <= '.$maxps;
$sql_alturaMIN = ' AND p.altura >= '.$minaltura;
$sql_alturaMAX = ' AND p.altura <= '.$maxaltura;
$sql_pesoMIN = ' AND p.peso >= '.$minpeso;
$sql_pesoMAX = ' AND p.peso <= '.$maxpeso;
$sql_numero_pokedex = ' AND p.numero_pokedex = '.$numero_pokedex;
$sql_ataqueMIN = ' AND eb.ataque >= '.$minataque;
$sql_ataqueMAX = ' AND eb.ataque <= '.$maxataque;
$sql_defensaMIN = ' AND eb.defensa >= '.$mindefensa;
$sql_defensaMAX = ' AND eb.defensa <= '.$maxdefensa;
$sql_velocidadMIN = ' AND eb.velocidad >= '.$minvelocidad;
$sql_velocidadMAX = ' AND eb.velocidad <= '.$maxvelocidad;

//Concatenar los string anteriores
$sql = $sql_main.$sql_conn.$sql_name;
/*if ($nombre) {
	$sql = $sql.$sql_name;
}*/
if ($tipo) {
	$sql = $sql.$sql_tipo;
}
if ($maxps) {
	$sql = $sql.$sql_psMAX;
}
if ($minps) {
	$sql = $sql.$sql_psMIN;
}
if ($maxaltura) {
	$sql = $sql.$sql_alturaMAX;
}
if ($minaltura) {
	$sql = $sql.$sql_alturaMIN;
}
if ($maxpeso) {
	$sql = $sql.$sql_pesoMAX;
}
if ($minpeso) {
	$sql = $sql.$sql_pesoMIN;
}
if ($numero_pokedex) {
	$sql = $sql.$sql_numero_pokedex;
}
if ($maxataque) {
	$sql = $sql.$sql_ataqueMAX;
}
if ($minataque) {
	$sql = $sql.$sql_ataqueMIN;
}
if ($maxdefensa) {
	$sql = $sql.$sql_defensaMAX;
}
if ($mindefensa) {
	$sql = $sql.$sql_defensaMIN;
}
if ($maxvelocidad) {
	$sql = $sql.$sql_velocidadMAX;
}
if ($minvelocidad) {
	$sql = $sql.$sql_velocidadMIN;
}
if ($aux) {
	$sql = $sql.$order;
}else{
	$sql = $sql.' ORDER BY p.numero_pokedex ASC';
}
echo $nombre;
echo "\n".$sql."\n";
$result = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_array($result);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}else{
	    echo "Query OK \n";
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
			echo"<td id='num_pokedex' name='num_pokedex'>".$row['numero_pokedex']."</td>";
			echo"</tr>";
			
			echo"<tr>";
			echo"<td id='nombre' >Nombre:</td>";
			echo"<td id='nombre' name='nombre'>".$row['nombre']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Altura:</td>";
			echo"<td id='Altura' name='altura'>".$row['altura']."</td>";
			echo"</tr>";

			echo"<tr>";
			echo"<td>Peso:</td>";
			echo"<td>".$row['peso']."</td>";
			echo"</tr>";


			echo"<tr>";
			//Boton que redireccion llamado MasInfo
			echo"<td colspan='2'><a href='SQL_MasInfo.php?nombre=$row[nombre]'><input type='button' value='Mas Info' id='mas_info' name='mas_info'></a></td>";
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


