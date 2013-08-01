<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");

//VARIABLES PARA LA HORA
$fechaTotal=date("Y-m-d H:i:s");
$fecha=explode(" ", $fechaTotal);
$fecha_actual=$fecha[0];
$hora=explode(":", $fecha[1]);
$hora_actual=$hora[0].":".$hora[1];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />

<!-- SPRY -->
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<!-- FECHA -->
<link type="text/css" href="../../../../js/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../../../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../../../../js/ui/jquery.ui.datepicker.js"></script>
<script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
var jfec = jQuery.noConflict();
jfec(function() {
	jfec("#fecha").datepicker({
		showOn: 'button',
		buttonImage: '../../../images/calendar.gif',
		buttonImageOnly: true
	});
});
</script>

<!-- CKEDITOR -->
<script type="text/javascript" src="../../../js/ckeditor.js"></script>


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
            	<h2>Agregar - Cartas</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" id="form1" >
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" ><p><strong>De:</strong></p></td>
            	      <td width="80%" height="30" align="left"><input name="titulo" type="text" id="titulo" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right"><p><strong>Contenido:</strong></p></td>
            	      <td width="80%" height="30" align="left" >&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea class="ckeditor" name="contenido" id="contenido"></textarea>
          	          </label>
                      </p></td>
           	        </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Fecha publicación:</strong></p></td>
            	      <td><input name="fecha" type="text" id="fecha" value="<?php echo $fecha_actual; ?>" size="20" /></td>
          	      </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Hora publicación:</strong></p></td>
            	      <td><span id="sprytextfield1">
            	        <input name="hora" type="text" id="hora" value="<?php echo $hora_actual; ?>" size="20" />
            	        <span class="textfieldRequiredMsg">Ingrese la hora a publicar</span> <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
          	      </tr>
            	    <tr>
            	      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" />                    <label>
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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "time");
</script>
</body>
</html>