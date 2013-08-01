<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");

//VARIABLES
$id=$_REQUEST["id"];

//PREGUNTA
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_encuesta_preguntas WHERE id=$id;", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//OPCIONES
$rst_opciones=mysql_query("SELECT * FROM ".$tabla_suf."_encuesta_opciones WHERE ques_id=$id ORDER BY id ASC;", $conexion);
$num_opciones=mysql_num_rows($rst_opciones);
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
            	<h2>Modificar - Encuesta</h2>
           	  <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="actualizar.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right"><p><strong>Pregunta:</strong></p></td>
            	      <td width="80%" height="30" align="left">
                      	<input name="titulo" type="text" id="titulo" value='<?php echo stripslashes($fila_query["ques"]) ?>' size="70" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right"><p><strong>Opciones</strong></p></td>
            	      <td height="30" align="left">&nbsp;</td>
          	      </tr>
                  
            	    <?php
                    	for($i=1;$i<=$num_opciones;$i++){
							$cont=0;
							$aumt=1;
							while($fila_opciones=mysql_fetch_array($rst_opciones)){
					?>
                    <tr>
            	      <td height="30" align="right"><p><strong>Respuesta <?php echo $aumt; ?>:</strong></p></td>
            	      <td height="30" align="left"><p>
            	        <input name="resp<?php echo $cont;?>" type="text" id="resp<?php echo $cont;?>" size="50" value="<?php echo $fila_opciones["value"] ?>" />
            	        <input name="id_opcion[]" type="hidden" id="id_opcion<?php echo $cont;?>" value="<?php echo $fila_opciones["id"] ?>" />
            	      </p></td>
          	      	</tr>
                    <?php $cont++; $aumt++;}} ?>
                <tr>
                  <td colspan="2" align="center"><label>
                    <input type="submit" name="guardar" id="guardar" value="Guardar" />
                    <input name="cant_opciones" type="hidden" id="cant_opciones" value="<?php echo $num_opciones; ?>" />
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