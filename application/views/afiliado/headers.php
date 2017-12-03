<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Menú afiliado </title>
	<link rel = "stylesheet" type = "text/css" 
  	 href = "<?php echo base_url(); ?>css/estilos.css">

<nav>
	
			<ul>
				
				<li><a href="/Proyectogrupo4/index.php/afiliados/"><FONT FACE="arial">Inicio</FONT></a></li>
				<li><a href="/Proyectogrupo4/index.php/Generador/"><FONT FACE="arial">Generar Código QR</FONT></a></li>
				<li><a href="/Proyectogrupo4/index.php/LoginAfiliado/cerrar_sesion"><FONT FACE="arial">Cerrar Sesión</FONT></a></li>

				</FONT>

			</ul>

		</nav>
		<br><br><br><br>
		<center><FONT size=5 FACE="arial">Escanea tu código para ver la información </FONT></center>
<center><img src="http://localhost/Proyectogrupo4/codigo/test.png"; width=300 height=300 border=10 ></center>
<center><FONT size=2 FACE="arial">Para ver la información del código QR podrá utilizar la cámara de su celular. <br> 
Si esto no sirve, por favor descargue una app desde la tienda de aplicaciones que pueda escanear este tipo de código. </FONT></center>
	</body>
</html>