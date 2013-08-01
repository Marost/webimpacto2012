<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");

$user=$_SESSION["user-dr16"];

//EMPRESA
$rst_empresa=mysql_query("SELECT * FROM ".$tabla_suf."_empresa WHERE id=1", $conexion);
$fila_empresa=mysql_fetch_array($rst_empresa);

//PORTADA
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_portada WHERE id=". $_REQUEST["id"].";", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//PRIVILEGIOS USUARIO
$rst_prv_user=mysql_query("SELECT * FROM ".$tabla_suf."_usuario_privilegios WHERE usuario='$user';", $conexion);
$fila_prv_user=mysql_fetch_array($rst_prv_user);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />
<link type="text/css" href="../../../js/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
var j = jQuery.noConflict();
j(function() {
	j("#fecha").datepicker({
		showOn: 'button',
		buttonImage: '../../images/calendar.gif',
		buttonImageOnly: true
	});
});
</script>
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
            	<h2>Modificar - Portada</h2>
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
            	      <td height="30" align="right" class="texto_izq"><p><strong>Fecha:</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><input name="fecha" type="text" id="fecha" value="<?php echo $fila_query["fecha"] ?>" size="30" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="right"><p><strong>Imagen:</strong></p></td>
            	      <td width="80%" align="left"><p>
            	        <label for="archivo"></label>
            	        <input type="file" name="archivo" id="archivo" />
          	        </p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Imagen:</strong></p></td>
            	      <td align="left"><img src="../../../imagenes/upload/escala-140.php?imagen=<?php echo $fila_query["imagen"] ?>" />
           	          <input name="imagen-actual" type="hidden" id="imagen-actual" value="<?php echo $fila_query["imagen"] ?>" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right" class="texto_izq"><p><strong>PDF:</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><label for="pdf"></label><input type="file" name="pdf" id="pdf" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right" class="texto_izq"><p><strong>PDF actual:</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><?php echo $fila_query["pdf"] ?>
           	          <input name="pdf-actual" type="hidden" id="pdf-actual" value="<?php echo $fila_query["pdf"] ?>" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right" class="texto_izq"><p><strong>Revista:</strong></p></td>
            	      <td height="30" align="left" class="texto_der">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="30" colspan="2" align="center" class="texto_izq"><textarea name="revista" cols="70" rows="10" class="ckeditor" id="contenido2"><?php echo $fila_query["revista"] ?></textarea></td>
          	      </tr>
            	    <tr>
            	      <td align="right">&nbsp;</td>
            	      <td align="left">&nbsp;</td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><label>
                    <input type="submit" name="guardar" id="guardar" value="Guardar" />
                    &nbsp;
                    <input type="reset" name="button2" id="button2" value="Limpiar Datos" />
                  </label></td>
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