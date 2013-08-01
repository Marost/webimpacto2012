<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | Diario16</title>
<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
            	<h2>Agregar - Encuesta</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="form-agregar-respuestas.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="23%" height="30" align="right" class="texto_izq"><p><strong>Titulo:</strong></p></td>
            	      <td width="77%" height="30" align="left" class="texto_der"><span id="sprytextfield2">
            	        <input name="titulo" type="text" id="titulo" size="50" />
           	          <span class="textfieldRequiredMsg">Ingrese el titulo</span></span></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right" class="texto_izq"><p><strong>Cantidad de respuestas</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><span id="sprytextfield1">
                      <input name="respuestas" type="text" id="respuestas" size="50" />
                      <span class="textfieldRequiredMsg">Ingrese la cantidad de opciones</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><input type="submit" name="guardar" id="guardar" value="Siguiente" /></td>
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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>