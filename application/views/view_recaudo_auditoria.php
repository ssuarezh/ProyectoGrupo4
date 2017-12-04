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
    width: 180px; 
    text-align: left;    
    border-collapse: collapse;
    
}
th {     
	font-size: 24px;     
	font-weight: normal;  
	width: 180px;   
	padding: 20px;     
	background: #b9c9fe;
    border-top: 4px 
    solid #aabcfe;    
    border-bottom: 1px 
    solid #fff; 
    color: #039;
    
}

td {  
	width: 180px;  
	padding: 18px;     
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




	
</style>





<table border="1" align= "center">

<tr>
	<th> ID Auditoria </th>
	<th> Accion  </th>
	<th> IP Maquina </th>
	<th> Tabla afectada </th>
	<th> Fecha </th>
	<th> Descripcion </th>
	<th> ID Usuario </th>

</tr>

	<?php
	foreach ($consulta->result() as $fila) {
	echo "<tr>

		<td>".  $fila->id ." </td>
		<td>".  $fila->Accion_Auditoria ." </td>
		<td>".  $fila->Ip_Maquina_Auditoria  ."</td>
		<td>".  $fila->TablaAfectada_Auditoria  ."</td>
		<td>".  $fila->Fecha_Auditoria  ."</td>
		<td>".  $fila->Descripcion_Auditoria ."</td>
		<td>".  $fila->id_Usuario ." </td>
	</tr>";
	
		}
		?>

	</table>
	</div>
</section>


		
	
