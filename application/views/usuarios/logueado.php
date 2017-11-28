<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8" />
    <title> Usuarios </title>
 </head>
 <body>
    <h1> Bienvenido/a <?php echo $nombre ?> </h1>
    <p>
       <a href="<?php echo base_url() ?>index.php/LoginControlador/cerrar_sesion"> Cerrar sesión </a>
    </p>
 </body>
</html>