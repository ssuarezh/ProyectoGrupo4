<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<title>Cargar archivo</title>
    
    <style >
	 {
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
div.a
 {
	color: black;
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
    <h1></h1>
  
	    
    <?= form_open_multipart("cargarArchivo/cargarDatos")?>
    <div class="a">
    <?= form_label('Cargue su archivo .csv')?>
    </div>

    <?= form_upload([
        'name'  => 'archivo',
        'id'    => 'archivo'
    ])?>
    <?= form_submit('sub','Cargar')?>  
    <?= form_close()?>
    <div class="a">
    <?= form_label('Cargue su archivo .csv')?>
    </div>
</body>
</html>