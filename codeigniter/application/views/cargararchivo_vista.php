<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
    <h1>Cargar archivos</h1>
    <?= form_open_multipart("cargarArchivo/cargarDatos")?>
    <?= form_label('Archivo')?>
    <?= form_upload([
        'name'  => 'archivo',
        'id'    => 'archivo'
    ])?>
    <?= form_submit('sub','Cargar')?>  
    <?= form_close()?>

</body>
</html>