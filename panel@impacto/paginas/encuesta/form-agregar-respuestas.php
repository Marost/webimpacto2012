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
                <form action="guardar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <?php for($i=1;$i<=$_POST["respuestas"];$i++){ ?>
                      <tr>
                        <td width="128" align="right"><p><strong>Respuesta <?php echo $i; ?></strong></p></td>
                        <td width="572"><p>
                          <strong>
                          <input name="p<?php echo $i;?>" type="text" id="p<?php echo $i;?>" size="50" maxlength="50">
                        </strong></p></td>
                      </tr>
                    <?php } ?>
                <tr>
                  <td colspan="2" align="center" class="texto_negro16-MyriadPro">
                  <input name="titulo" type="hidden" value="<?php echo $_POST["titulo"];?>">
                  <input type="hidden" name="respuestas" value="<?php echo $_POST["respuestas"];?>">
                  <input type="submit" name="guardar" id="guardar" value="Guardar" />
                  <label>
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