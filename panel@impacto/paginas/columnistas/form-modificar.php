<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");

//COLUMNISTA
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_columnista WHERE id=". $_REQUEST["id"].";", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//PUBLICAR
$rst_publicar=mysql_query("SELECT * FROM ".$tabla_suf."_publicar WHERE id>0 ORDER BY id ASC", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />
<script src="../../js/ckeditor.js" type="text/javascript"></script>
<script src="../../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
            	<h2>Modificar - Columnista</h2>
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
            	      <td height="30" align="right" class="texto_izq"><p><strong>Nombre:</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><input name="nombre" type="text" id="nombre" value="<?php echo $fila_query["nombre"] ?>" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right" class="texto_izq"><p><strong>Apellidos:</strong></p></td>
            	      <td height="30" align="left" class="texto_der"><input name="apellidos" type="text" id="apellidos" value="<?php echo $fila_query["apellidos"] ?>" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Foto:</strong></p></td>
            	      <td align="left"><p>
            	        <label for="foto"></label>
            	        <input type="file" name="foto" id="foto" />
          	        </p></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" align="right"><p><strong>Foto actual:</strong></p></td>
            	      <td width="80%" align="left"><img src="../../../imagenes/columnistas/<?php echo $fila_query["foto"] ?>" height="70" />
           	          <input name="foto-actual" type="hidden" id="foto-actual" value="<?php echo $fila_query["foto"] ?>" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right"><p><strong>Descripcion:</strong></p></td>
            	      <td height="30" align="left">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea class="ckeditor" name="descripcion" id="descripcion"><?php echo $fila_query["descripcion"] ?></textarea>
          	          </label>
          	        </p></td>
          	      </tr>
            	    <tr>
            	      <td align="right"><p><strong>Publicar:</strong></p></td>
            	      <td><span id="spryselect2">
            	        <select name="publicar" id="publicar">
            	          <option value="0">[ Seleccionar opcion ]</option>
            	          <?php while ($fila_publicar=mysql_fetch_array($rst_publicar)){
                                if ($fila_publicar["id"]==$fila_query["publicar"])
                                    echo "<option selected=''  value='". $fila_publicar["id"] ."'>". $fila_publicar["publicar"] ."</option>";
                                else
                                    echo "<option value='". $fila_publicar["id"] ."'>". $fila_publicar["publicar"] ."</option>";
                            }
                          ?>
          	          </select>
            	        <span class="selectInvalidMsg">Selecciona una opci&oacute;n.</span><span class="selectRequiredMsg">Seleccione una opcion</span></span></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center"><label>
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
<script type="text/javascript">
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"0"});
</script>
</body>
</html>