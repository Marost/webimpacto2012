<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
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
<script src="../../../../js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="../../../../js/jquery.uniquefield.js" type="text/javascript"></script>
<script type="text/javascript">
var j = jQuery.noConflict();
j(function(){
	j('#usuario').uniqueField({
		url: 'ajax.php',
		baseId: 'exam_y'
	});
	j('#email').uniqueField({
		url: 'ajax.php',
		baseId: 'exam_z'
	});
});
</script>

<script>
function passwordStrength(password)
{
	var desc = new Array();
	desc[0] = "Muy Débil";
	desc[1] = "Débil";
	desc[2] = "Mejor";
	desc[3] = "Medio";
	desc[4] = "Fuerte";
	desc[5] = "Muy Fuerte";

	var score   = 0;
	if (password.length > 6) score++;
	if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;
	if (password.match(/\d+/)) score++;
	if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score++;
	if (password.length > 12) score++;

	 document.getElementById("passwordDescription").innerHTML = desc[score];
	 document.getElementById("passwordStrength").className = "strength" + score;
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
            	<h2>Agregar - Usuario</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td colspan="2"><span class="mensaje">DATOS DE USUARIO</span></td>
                </tr>
                <tr>
                  <td width="20%" align="right"><p> <strong>
                    <label> Usuario:</label>
                  </strong></p></td>
                  <td width="80%" align="left"><input name="usuario" type="text" id="usuario" size="30" style="float: left" /></td>
                </tr>
                <tr>
                  <td width="20%" align="right"><p> <strong>
                    <label> Contrase&ntilde;a:</label>
                  </strong></p></td>
                  <td width="80%" align="left"><span id="spryconfirm1">
                  <input name="rpt-clave" type="password" id="rpt-clave" size="30" onKeyUp="passwordStrength(this.value)" />
                  <span class="confirmRequiredMsg">Ingrese una contrase&ntilde;a</span><span class="confirmInvalidMsg">Las contrase&ntilde;as no coinciden.</span></span></td>
                </tr>
                <tr>
                  <td width="20%" align="right"><p> <strong>
                    <label> Repetir Contrase&ntilde;a:</label>
                    </strong></p></td>
                  <td width="80%" align="left"><input name="clave" type="password" id="clave" size="30" /></td>
                </tr>
                <tr>
                  <td align="right"><p><strong>Medidor de contraseña</strong></p></td>
                  <td align="left"><p>&nbsp;</p>
                    <div id="passwordDescription">Contraseña no ingresada</div>
                    <div id="passwordStrength" class="strength0"></div>
                    </p></td>
                </tr>
                <tr>
                  <td align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="left" class="texto_negro16-MyriadPro"><span class="mensaje">DATOS PERSONALES</span></td>
                  </tr>
                <tr>
                  <td align="right"><p> <strong>
                    <label> Nombre</label>
                    : </strong></p></td>
                  <td align="left"><p><span id="sprytextfield2">
                    <input name="nombre" type="text" id="nombre" size="50" />
                  <span class="textfieldRequiredMsg">Ingrese su Nombre</span></span></p></td>
                </tr>
                <tr>
                  <td align="right"><p> <strong>
                    <label> Apellidos:</label>
                  </strong></p></td>
                  <td align="left"><p><span id="sprytextfield3">
                    <input name="apellidos" type="text" id="apellidos" size="50" />
                  <span class="textfieldRequiredMsg">Ingrese su Apellido</span></span></p></td>
                </tr>
                <tr>
                  <td align="right"><p> <strong>
                    <label> Email:</label>
                  </strong></p></td>
                  <td align="left"><p><span id="sprytextfield1">
                    <input name="email" type="text" id="email" size="50"  style="float:left;"/>
                    <span class="textfieldRequiredMsg">Ingrese un Email</span><span class="textfieldInvalidFormatMsg">Email no v&aacute;lido.</span></span></p></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro">&nbsp;</td>
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