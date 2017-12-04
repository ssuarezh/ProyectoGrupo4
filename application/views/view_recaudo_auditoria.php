<section id="contable" class="section green">
<div class= "container" id="body">


<style>
	table{
		color:black;
		border-color: black;

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

