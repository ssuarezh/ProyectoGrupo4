
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

	</div>
</section>

