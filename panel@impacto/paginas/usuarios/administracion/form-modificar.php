<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");

$usuario=$_REQUEST["usuario"];

//USUARIO
$rst_usuario=mysql_query("SELECT * FROM ".$tabla_suf."_usuario WHERE usuario='$usuario';", $conexion);
$fila_usuario=mysql_fetch_array($rst_usuario);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />
<script src="../../../../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
            	<h2>Modificar - Usuario</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="actualizar.php?usuario=<?php echo $_REQUEST["usuario"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="left"><span class="mensaje">DATOS DE USUARIO</span></td>
           	        </tr>
            	    <tr>
            	      <td width="20%" align="right"><p> <strong>
            	        <label> Usuario:</label>
          	        </strong></p></td>
            	      <td width="80%" align="left"><input name="usuario" type="text" disabled="disabled" id="usuario" value="<?php echo $fila_usuario["usuario"]; ?>" size="30" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="right"><p> <strong>
            	        <label> Contrase&ntilde;a:</label>
          	        </strong></p></td>
<td width="80%" align="left"><span id="spryconfirm1">
            	        <input name="rpt-clave" type="password" id="rpt-clave" value="<?php echo $fila_usuario["clave"]; ?>" size="30" />
           	          <span class="confirmRequiredMsg">Ingrese una contrase&ntilde;a</span><span class="confirmInvalidMsg">Las contrase&ntilde;as no coinciden.</span></span></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="right"><p> <strong>
            	        <label> Repetir Contrase&ntilde;a:</label>
          	        </strong></p></td>
            	      <td width="80%" align="left"><input name="clave" type="password" id="clave" value="<?php echo $fila_usuario["clave"]; ?>" size="30" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
            	      <td width="80%">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td colspan="2" align="left" class="texto_negro16-MyriadPro"><span class="mensaje">DATOS PERSONALES</span></td>
           	        </tr>
            	    <tr>
            	      <td align="right"><p> <strong>
            	        <label> Nombre</label>
            	        : </strong></p></td>
            	      <td align="left"><p><span id="sprytextfield2">
            	        <input name="nombre" type="text" id="nombre" value="<?php echo $fila_usuario["nombre"]; ?>" size="50" />
           	          <span class="textfieldRequiredMsg">Ingrese su Nombre</span></span></p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p> <strong>
            	        <label> Apellidos:</label>
          	        </strong></p></td>
            	      <td align="left"><p><span id="sprytextfield3">
            	        <input name="apellidos" type="text" id="apellidos" value="<?php echo $fila_usuario["apellidos"]; ?>" size="50" />
           	          <span class="textfieldRequiredMsg">Ingrese su Apellido</span></span></p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p> <strong>
            	        <label> Email:</label>
          	        </strong></p></td>
            	      <td align="left"><p><span id="sprytextfield1">
            	        <input name="email" type="text" id="email" value="<?php echo $fila_usuario["email"]; ?>" size="50" />
           	          <span class="textfieldRequiredMsg">Ingrese un Email</span><span class="textfieldInvalidFormatMsg">Email no v&aacute;lido.</span></span></p></td>
          	      </tr>
            	    <tr>
            	      <td colspan="2" align="right">&nbsp;</td>
           	        </tr>
            	    <tr>
            	      <td colspan="2" align="right">&nbsp;</td>
           	        </tr>
            	    <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><label>
                    <input type="submit" name="guardar" id="guardar" value="Guardar" />
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
<!--
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "clave");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
</body>
</html>