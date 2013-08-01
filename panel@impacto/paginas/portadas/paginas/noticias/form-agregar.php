<?php
session_start();
include("../../../../conexion/conexion.php");
include("../../../../conexion/verificar_sesion.php");

$user=$_SESSION["user-dr16"];
//PRIVILEGIOS USUARIO
$rst_prv_user=mysql_query("SELECT * FROM ".$tabla_suf."_usuario_privilegios WHERE usuario='$user';", $conexion);
$fila_prv_user=mysql_fetch_array($rst_prv_user);

//EMPRESA
$rst_empresa=mysql_query("SELECT * FROM ".$tabla_suf."_empresa WHERE id=1", $conexion);
$fila_empresa=mysql_fetch_array($rst_empresa);

$idportada=$_REQUEST["portada"];
$idpagina=$_REQUEST["pagina"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../../css/style-listas.css" />

<link type="text/css" href="../../../../../js/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../../../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../../../../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../../../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../../../../../js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
var j = jQuery.noConflict();
j(function() {
	j("#fecha").datepicker({
		showOn: 'button',
		buttonImage: '../../../images/calendar.gif',
		buttonImageOnly: true
	});
});
</script>
<script type="text/javascript" src="../../../../js/ckeditor.js"></script>
</head>

<body>
<div id="contenedor" class="limpiar">
	<?php include("../../../../cabecera.php") ?>
    <div id="cuerpo" class="limpiar">
    	<div class="interior">
        	<div id="panel-izq">
				<?php include("../../../../menu-izq.php"); ?>
            </div><!--FIN PANEL IZQ-->
            <div id="panel-der">
            	<h2><a href="../listar.php?portada=<?php echo $idportada ?>">Paginas</a> &lt; <a href="listar.php?portada=<?php echo $idportada ?>&pagina=<?php echo $idpagina ?>">Noticias</a> &lt; Agregar Noticia</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php?portada=<?php echo $idportada; ?>&pagina=<?php echo $idpagina; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Titulo:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der"><input name="titulo" type="text" id="titulo" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" class="texto_izq"><p><strong>Contenido:</strong></p></td>
            	      <td width="80%" height="30" align="left" class="texto_der">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea class="ckeditor" name="contenido" id="contenido"></textarea>
          	          </label>
                      </p></td>
           	        </tr>
            	    <tr>
            	      <td height="30" align="right" class="texto_izq"><p><strong>Fecha:</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><input name="fecha" type="text" id="fecha" size="30" /></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro"><input type="submit" name="guardar" id="guardar" value="Guardar" />                    <label>
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