<?php

 require ("facturasyrecibos.php");
 require ("fpdf.php");
 //require "../auxiliar"


 $idparte = $_GET['idparte'];
 $serie = $_GET['serie'];//HAY QUE PASAR LA SERIE POR LA URL

$con = mysqli_connect('127.0.0.1', 'root', 'segymant', 'db693261871');
$con->query("SET NAMES 'utf8'");

$consulta = mysqli_query($con, "select * from `clientes` inner join `partes` on clientes.IDCLIENTE = partes.IDCLIENTE where partes.IDPARTE = '$idparte'");

$arr = mysqli_fetch_assoc($consulta);

$hoy = date("Y-m-d");

//var_dump($arr);die;

$facturaorecibo = new FacturayRecibo(null, $arr['CIF'], $arr['NOMBRE'], $arr['APELLIDOS'], $arr['DIRCLI'], $arr['CP'], $arr['POBLACION'], $hoy, $serie, $arr['IDPARTE'], $arr['SINIESTRO'], null, 'PENDIENTE');


//echo $con->connection_status();



  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script type="text/javascript" src="rellenarcampos.js"></script>
  	<title>Crear Facturas o Recibo</title>
  </head>
  <body>
  	<div id="cabecera">
	

	<header id="header" class="">
		<img src="logo.jpg" alt="segymant.sl">
	</header><!-- /header -->
<form action="#" method="post" accept-charset="utf-8">

		<input type="hidden" name="siniestro" id="siniestro">
		<input type="hidden" name="idparte" id="idparte">
	
	<fieldset>
		<legend>Datos Cliente</legend>
		<ul>
			<li><input type="text" name="dni" id="dni" 
				value="<?php echo $facturaorecibo->getDni(); ?>"></li>
			<li><input type="text" name="nombre" id="nombre" value="<?php echo $facturaorecibo->getNombre(); ?>"></li>
			<li><input type="text" name="apellidos" id="apellidos" value="<?php echo $facturaorecibo->getApellidos(); ?>"></li>
			<li><input type="text" name="direccion" id="direccion" value="<?php echo $facturaorecibo->getDireccion(); ?>"></li>
			<li><input type="text" name="cp" id="cp" value="<?php echo $facturaorecibo->getCp();?>"></li>


		</ul>
	</fieldset>
	<fieldset>
		<legend>Datos factura</legend>
		<ul>
			<li>Nº Factura : <input type="text" name="numero" id="numero" value="<?php $facturaorecibo->getNumFactura();?>" disabled></li>
			<li>Serie      : <?php echo $facturaorecibo->getSerie(); ?></li>
			<li>Fecha      : <input type="date" name="fecha" value="<?php echo $hoy ?>" id="fecha"></li>
		</ul>
	</fieldset>
</div>

<div id="cuerpo">

		<div id="cabezalinea">

			<span><b>Descripcion</b></span><span><b>Importe</b></span>

		</div>
	

  <hr>

  <textarea name="" id="sinImporte" cols="100" rows="2"></textarea>
  <ul id="lista">

  	<li>

  	<input type="checkbox" name="">
 <textarea name="" id="" cols="100" rows="2"></textarea>
 	 	<label for="importe">Importe :</label>
  		<input type="text" name="importe" id="importe" >

    </li>

  </ul>


</div>
<hr>
<table>
	<th>Base Imponible</th>
	<th>I.V.A</th>
	<th>Importe I.V.A</th>
	<th>Total</th>
	<tr>
		<td></td>
	
		<td>
			<select name="iva" id="iva">
	                <option value="0.21">21%</option>
	                <option value="0.10">10%</option>
	                
	        </select>
        </td>
        <td></td>
        <td></td>
    </tr>
</table>
<hr>
<div id="sumatorio">
	<h3>TOTAL FACTURA .............................................................................          <span id="suma"></span></h3>
</div>

<input type="button" value="nueva linea" id="nuevo" class="btn btn-primary">
<input type="button" value="borrar linea" id="borrar" class="btn btn-primary">
<input type="button" value="Guardar" id="guardar" class="btn btn-success">
<input type="button" value="Cancelar" id="cerrar" class="btn btn-danger">

</form>

  </body>
  </html>