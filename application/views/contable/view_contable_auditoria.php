
<section id="contable" class="section green">
<div class= "container" id="body">



<style >
	
body{
background: url(<?= base_url()?>static/imagenes/fondo.jpg); 
display: flex;
min-height: 10vh;
margin: 100;

}
table {     

	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 24px;    
    margin: 245px;     
    width: 580px; 
    text-align: left;    
    border-collapse: collapse;
    background-color: White; 

}
th {     
	font-size: 25px;     
	font-weight: normal;     
	padding: 20px;     
	background: #b9c9fe;
    border-top: 4px 
    solid #aabcfe;    
    border-bottom: 1px 
    solid #fff; 
    color: #039;
    
}

td {    
	padding: 20px;     
	background: #e8edff;     
	border-bottom: 2px solid #fff;
    color: #669;    
    border-top: 2px 
    solid transparent; 
}

tr:hover td { 
	background: #d0dafd; 
	color: #339; 
}

input{

	padding: 20px;     
	background: #e8edff;     
	border-bottom: 2px solid #fff;
    color: #669;    
    border-top: 2px 
    solid transparent; 
}


	
</style>





<table border="1" align= "center">

<tr>
	<th> ID Auditoria </th>
	<th> IP Maquina </th>
	<th> Fecha </th>
	<th> Tabla Afectada </th>
	<th> Descripcion </th>

</tr>

	<?php
	foreach ($consulta->result() as $fila) {
	echo "<tr>

		<td>".  $fila->id ." </td>
		<td>".  $fila->ip_maquina  ."</td>
		<td>".   $fila->fecha_auditoria  ."</td>
		<td>".   $fila->tabla_afectada_auditoria  ."</td>
		<td>".  $fila->descripcion_auditoria ."</td>
	</tr>";
	
		}
		?>

	</table>

	<a href="<?= base_url()?>index.php/LoginControladorContable/iniciar_sesion_post"> <input type="submit" value="Volver" > </a>
	</div>
</section>


		
	
