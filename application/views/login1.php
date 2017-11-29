<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Iniciar Sesión</title>
	<style >
	 {
	margin: 0;
	padding: 0;
	font-family: sans-serif;
	box-sizing: border-box;
}

body{
background: url(<?= base_url()?>static/imagenes/fondo.jpg); 
display: flex;
min-height: 100vh;
margin: 0;

}

form 
{
	margin: auto;
	width: 50%;
	max-width: 500px;
	background: rgba(255,255,255,0.7);
	padding: 30px;
	border: 1px solid rgba (0,0,0,0,2);
}
h2
{
	text-align: center;
	margin-bottom: 20px;
	color:rgba(0,0,0,0,5);
}

input 
{
	display: block;
	padding: 10px;
	width: 100%;
	margin: 30px 0;
	font-size: 20px;
}
input[type ="submit"]
{
 background: linear-gradient(#ffda53,#ff8940);
 border: 0;
 color:brown;
 opacity: 0.8
 cursor: pointer;
 border-radius: 20px;
 margin-bottom: 0;
}
input[type ="submit"]:hover
{
	opacity:1;
}
input[type ="submit"]:active
{
	transform-scale:(0,95);
}
div.message
 {
	color: red;
	font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
	font-size: 20px;
	margin-bottom: 5%;
}
@media (max-width: 768px) 
{
	form
	{
		width:95%;
	}
	
}	
	</style>
</head>
<body>
	<form action="<?= base_url()?>index.php/LoginControlador/iniciar_sesion_post" method="post">
	<!--div class="message">
	     <?= $message ?>
    </div-->
	<h2>Login Usuario Recaudo</h2>
	   <input type="text" placeholder="&#128590; Usuario" name="nombre" required="Este campo es requerido">
	   <input type="password" placeholder="&#128272; Contraseña" name="contrasena" required="Este campo es requerido">
	    <input type="submit" value="Iniciar sesión" >
	    <h2><a href="<?php echo base_url() ?>index.php/LoginControladorContable/iniciar_sesion"> Login Contable </a></h2>
	</form>
</body>
</html>

<!--DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <style >
  * {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  box-sizing: border-box;
}

body{
background: #DEDEDE;
display: flex;
min-height: 100vh;
margin: 0;

}

form 
{
  margin: auto;
  width: 50%;
  max-width: 500px;
  background: #f3f3f3f3;
  padding: 30px;
  border: 1px solid rgba (0,0,0,0,2);
}
h2
{
  text-align: center;
  margin-bottom: 20px;
  color:rgba(0,0,0,0,5);
}
input 
{
  display: block;
  padding: 10px;
  width: 100%;
  margin: 30px 0;
  font-size: 20px;
}
input[type ="submit"]
{
 background: linear-gradient(#ffda53,#ff8940);
 border: 0;
 color:brown;
 opacity: 0.8
 cursor: pointer;
 border-radius: 20px;
 margin-bottom: 0;
}
input[type ="submit"]:hover
{
  opacity:1;
}
input[type ="submit"]:active
{
  transform-scale:(0,95);
}
div.message
 {
  color: red;
  font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
  font-size: 20px;
  margin-bottom: 5%;
}
@media (max-width: 768px) 
{
  form
  {
    width:95%;
  }
  
} 
  </style>
</head>
<body>
  <form method="post" action="<?php echo base_url() ?>index.php/LoginControlador/iniciar_sesion_post">
  <h2>Login Usuario</h2>
     <input type="text" placeholder="&#128590; Usuario" name="nombre" required="Este campo es requerido">
     <input type="password" placeholder="&#128272; Contraseña" name="contrasena" required="Este campo es requerido">
      <input type="submit" value="Iniciar sesión" >
  </form>
</body>
</html-->