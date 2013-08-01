<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");

//EMPRESA
$rst_empresa=mysql_query("SELECT * FROM ".$tabla_suf."_empresa WHERE id=1", $conexion);
$fila_empresa=mysql_fetch_array($rst_empresa);

$user=$_SESSION["user-dr16"];
$cebra=1;
$url="listar.php";
$idportada=$_REQUEST["portada"];

$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_portada_paginas WHERE id>0 AND portada=$idportada ORDER BY orden ASC;", $conexion);
$num_registros=mysql_num_rows($rst_query);
	
$registros=20;	
$pagina=$_GET["pag"];
if (is_numeric($pagina))
$inicio=(($pagina-1)*$registros);
else
$inicio=0;

$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_portada_paginas WHERE id>0 AND portada=$idportada ORDER BY orden ASC LIMIT $inicio, $registros;", $conexion);
$paginas=ceil($num_registros/$registros);
	
if ($num_registros==0)
{
	if ($buscar!="")		
		$mensaje2="No hay registros con el nombre: <b>$buscar</b>";
	else
		$mensaje2="No hay registros en la base de datos";
}

// MENSAJE DE ERROR
if($_REQUEST["mensaje"]==1)
{
	$mensaje="El registro fue agregado exitosamente";
}elseif($_REQUEST["mensaje"]==2)
		$mensaje="El registro fue modificado exitosamente";
elseif($_REQUEST["mensaje"]==3)
		$mensaje="El registro fue eliminado exitosamente";
elseif($_REQUEST["mensaje"]==4)
		$mensaje="Se ha producido un error al ingresar el nuevo registro";
elseif($_REQUEST["mensaje"]==5)
		$mensaje="Se ha producido un error al modificar el registro";
elseif($_REQUEST["mensaje"]==6)
		$mensaje="Se ha producido un error al eliminar el registro";	

//PRIVILEGIOS USER
$rst_prv_user=mysql_query("SELECT * FROM ".$tabla_suf."_usuario_privilegios WHERE usuario='$user'", $conexion);
$fila_prv_user=mysql_fetch_array($rst_prv_user);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css">
<script type="text/javascript" src="../../../../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../../../../js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript">
var jq = jQuery.noConflict();
  // When the document is ready set up our sortable with it's inherant function(s)
  jq(document).ready(function() {
    jq("#test-list").sortable({
      handle : '.handle',
      update : function () {
		  var order = jq('#test-list').sortable('serialize');
  		jq("#info").load("ordenar.php?"+order);
      }
    });
});
</script>
<script type="text/javascript">
function eliminarRegistro(registro, portada) {
if(confirm("¿Está seguro de borrar este registro?")) {
	document.location.href="eliminar.php?id="+registro+"&portada="+portada;
	}
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
            	  <h2>Lista - Paginas: </h2>
    <div id="contenido_total">
    	<div id="mensaje" >
    	  <p class="mensaje"><?php echo $mensaje; ?></p>
        </div>
        <div id="contenido">

              <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td ><p><a href="form-agregar.php?fotografo=<?php echo $idfotografo; ?>"><strong>AGREGAR FOTOS</strong></a></p></td>
                  </tr>
                  <tr>
                    <td>
<ul id="test-list">
	<?php while($fila_query2 = mysql_fetch_array($rst_query)){ ?>
        <li id="listItem_<?php echo $fila_query2["id"] ?>" class="alto">
            <img src="../../../img/arrow.png" alt="move" width="16" height="16" class="handle" />
            <a onclick="eliminarRegistro(<?php echo $fila_query2["id"] ?>, <?php echo $idportada ?>);" href="javascript:;">
            <img src="../../../images/eliminar_16.png" width="16" height="16" title="Eliminar registro" /></a>
            <a href="form-modificar.php?id=<?php echo $fila_query2["id"] ?>&portada=<?php echo $idportada ?>">
            <img src="../../../images/editar_16.png" width="16" height="16" /></a>
            <a href="noticias/listar.php?pagina=<?php echo $fila_query2["id"] ?>&portada=<?php echo $idportada ?>">
            <img src="../../../images/noticia_portada.png" width="16" height="16" alt="Noticias" title="Noticias de la página" /></a>
            <img src="../../../../imagenes/upload/<?php echo $fila_query2["imagen"] ?>" width="150" />
        </li>
    <?php } ?>
</ul>
                    <?php /*
                      <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
			 
                            while($fila_query2 = mysql_fetch_array($rst_query)){
                                    if ($contador_noticia==0) {echo '<tr>';}
                               echo '<td width="185" valign="baseline" align="center">'; ?>
                        <img src="../../../../imagenes/galeria/escala-180x140.php?imagen=<?php echo $fila_query2["foto"] ?>" /><br /><br />
                                       <a onclick="eliminarRegistro(<?php echo $fila_query2["id"] ?>, <?php echo $idfotografo ?>);" href="javascript:;">
                                       	<img src="../../../images/eliminar_16.png" width="16" height="16" title="Eliminar registro" /></a>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <a href="form-modificar.php?id=<?php echo $fila_query2["id"] ?>&amp;fotografo=<?php echo $idfotografo ?>">
                                       <img src="../../../images/editar_16.png" width="16" height="16" /></a>
                            	<?php echo '</td>'; $contador_noticia++;
                               if ($contador_noticia==4){ $contador_noticia=0; echo '</tr><tr><td>&nbsp;</td></tr>';}
                            } 
                        </table>*/?>
                    </td>
                  </tr>
                  <tr>
                    <td height="30" align="center">
                    <?php 
                    if ($_REQUEST["btnbuscar"]=="")
                    {
                    if (!isset($_GET["pag"]))
                    $pag = 1;
                    else
                    $pag = $_GET["pag"];
                    echo paginar($pag, $num_registros, $registros, "$url?pag=", 10);
                    }
                    ?>
                    </td>
                  </tr>
                  <tr>
                    <td height="30" colspan="2" align="center"><p><?php echo $mensaje2; ?></p></td>
                  </tr>
          </table>

      </div><!-- FIN CONTENIDO -->
  </div>
          </div><!--FIN PANEL DER-->
        </div><!--FIN INTERIOR-->
    </div><!--FIN CUERPO-->
</div>
</body>
</html>