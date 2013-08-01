<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");

//PORTADA
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_galeria WHERE id=". $_REQUEST["id"].";", $conexion);
$fila_query=mysql_fetch_array($rst_query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />

<script type="text/javascript" src="../../js/ckeditor.js"></script>

</head>

<body>
<div id="contenedor" class="limpiar">
	<?php include("../../cabecera.php") ?>
    <div id="cuerpo" class="limpiar">
    	<div class="interior">
        	<div id="panel-izq">
				<?php include("../../menu-izq.php"); ?>
            </div><!--FIN PANEL IZQ-->
            <div id="panel-der">
            	<h2>Modificar - Galeria</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="actualizar.php?id=<?php echo $_REQUEST["id"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Nombre:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><input name="titulo" type="text" id="titulo" value="<?php echo $fila_query["titulo"] ?>" size="30" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right"><p><strong>Contenido:</strong></p></td>
            	      <td height="30" align="left"><p>&nbsp;</p></td>
          	      </tr>
            	    <tr>
            	      <td height="30" colspan="2"><label for="contenido"></label>
            	        <textarea  class="ckeditor"  name="contenido" id="contenido"><?php echo $fila_query["contenido"]; ?></textarea></td>
          	      </tr>
            	    <tr>
            	      <td colspan="2" align="center" class="texto_negro16-MyriadPro"><label>
           	          <input type="submit" name="guardar" id="guardar" value="Guardar" /></label></td>
          	      </tr>
              </table>
                </form>
              </td>
            </tr>
        </table>
    </div><!-- FIN CONTENIDO TOTAL -->
          </div><!--FIN PANEL DER-->
        </div><!--FIN INTERIOR-->
    </div><!--FIN CUERPO-->
</div>
</body>
</html>