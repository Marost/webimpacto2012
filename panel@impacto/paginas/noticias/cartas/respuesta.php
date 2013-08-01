<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");

//VARIABLES
$idcarta=$_REQUEST["id"];

//MENSAJE
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_cartas WHERE id=$idcarta;", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//VERIFICACION DE USUARIO
$proceso=$_POST["proceso"];
if($proceso=="enviar"){
	
	//VARIABLES
	$email=$_POST["email"];
	$nombre=$fila_query["titulo"];
	$mensaje=$_POST["txtrespuesta"];
			
	//ENVAIR AL CORREO
	$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Impacto Evangelístico</title>
	<style type="text/css">
		body{ font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
		body{ margin:0;}
	</style>
	</head>
	<body>
	<p><img src="'.$web.'imagenes/logo.png" height="39" /></p>
	<p>Hola <strong>'.$nombre.'</strong>,</p>
	<p>Hemos recibido tu carta y esta es nuestra respuesta:</p>
	<p>'.$mensaje.'</p>
	<p><strong>Grcias por tu carta.</strong></p>
	<p><strong>Atentamente, Impacto Evangelístico</strong></p>
	<p><strong><a href="'.$web.'" target="_blank">Visitanos en www.impactoevangelistico.net</a></strong></p>
	</body>
	</html>';
	
	$from="noreply@impactoevangelistico.net";
	$asunto="Impacto Evangelístico | Respuesta a tu carta";
	$headers= "From: Impacto Evangelístico <".strip_tags($from)."> \r\n";
	$headers.= "MIME-Version: 1.0\r\n";
	$headers.= "Content-Type: text/html; charset=UTF-8\r\n";

	mail($email, $asunto, $body, $headers);
	
	header("Location: listar.php?mensaje=8");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css">
<script type="text/javascript">
function eliminarComentario(comentario, titulo) {
if(confirm("Se borrara la carta de: "+titulo+"\n¿Está seguro?")) {
	document.location.href="eliminar.php?id="+comentario;
	}
}
</script>
</head>

<body>
<div id="contenedor" class="limpiar">
	<?php include("../../../cabecera.php") ?>
    <div id="cuerpo" class="limpiar">
    	<div class="interior">
        	<div id="panel-izq">
				<?php include("../../../menu-izq.php"); ?>
            </div><!--FIN PANEL IZQ-->
            <div id="panel-der">
            	<h2>Respuesta a: <?php echo $fila_query["titulo"]; ?></h2>
    <div id="contenido_total">
    	<form method="post" id="formrespuesta">
      		<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td height="30"><p><span class="mensaje"><?php echo $mensaje; ?></span></p></td>
        </tr>
    <tr>
      <td colspan="2"><p><strong>Mensaje:</strong></p></td>
    </tr>
    <tr>
      <td colspan="2" align="center">

        <p>
          <textarea name="txtmensaje" cols="80" rows="7" readonly="readonly" id="txtmensaje"><?php echo $fila_query["contenido"]; ?></textarea>
        </p></td>
        </tr>
        <tr>
          <td height="30"><p></p></td>
        </tr>
        <tr>
          <td height="30"><p><strong>Respuesta:</strong></p></td>
        </tr>
        <tr>
          <td height="30" align="center"><p>
            <textarea name="txtrespuesta" id="txtrespuesta" cols="80" rows="7"></textarea>
          </p></td>
        </tr>
        <tr>
          <td height="30" align="center"><p>
            <input name="proceso" type="hidden" id="proceso" value="enviar" />
            <input name="email" type="hidden" id="email" value="<?php echo $fila_query["email"]; ?>" />
            <input type="submit" name="btnrespuesta" id="btnrespuesta" value="Enviar respuesta" />
          </p></td>
        </tr>
            </table>
      	</form>
    </div>
          </div><!--FIN PANEL DER-->
        </div><!--FIN INTERIOR-->
    </div><!--FIN CUERPO-->
</div>
</body>
</html>