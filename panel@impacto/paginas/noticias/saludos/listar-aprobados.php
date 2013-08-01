<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");

$cebra=1;
$url="listar-aprobados.php";
$buscar=$_REQUEST["busqueda"];

//LISTA COMENTARIOS
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_saludos WHERE estado_saludo='A' ORDER BY fecha DESC;", $conexion);
$num_registros=mysql_num_rows($rst_query);
	
$registros=15;	
$pagina=$_GET["pag"];
if (is_numeric($pagina))
$inicio=(($pagina-1)*$registros);
else
$inicio=0;

$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_saludos WHERE estado_saludo='A' ORDER BY fecha DESC LIMIT $inicio, $registros;", $conexion);
$paginas=ceil($num_registros/$registros);


if ($num_registros==0)
{
	if ($buscar!="")		
		$mensaje2="No hay registros con el nombre: <b>$buscar</b>";
	else
		$mensaje2="No hay registros en la base de datos";
}


//------- MENSAJE DE ERROR
if($_REQUEST["mensaje"]==1){
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
elseif($_REQUEST["mensaje"]==7)
	$mensaje="La carta fue aprobada y se publicara automaticamente";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css">
<script type="text/javascript">
function eliminarComentario(comentario, titulo) {
if(confirm("Se borrara el saludo de: "+titulo+"\n¿Está seguro?")) {
	document.location.href="eliminar.php?id="+comentario;
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
            	<h2><a href="listar.php">Saludos sin Aprobar</a> --- Saludos Aprobados</h2>
    <div id="contenido_total">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td height="30" align="center"><p><span class="mensaje"><?php echo $mensaje; ?></span></p></td>
        </tr>
    <tr>
      <td colspan="2" align="center">
        <table width="100%" border="0" cellpadding="5" cellspacing="0">
          <?php while($fila_query2=mysql_fetch_array($rst_query)){ ?>
          <tr<?php echo alt($zebra); $zebra++; ?>>
            <td width="80%"><p>Por: <strong><?php echo $fila_query2["nombre"]; ?></strong> el <strong><?php echo $fila_query2["fecha"]; ?></strong></p></td>
            <td width="20%" align="center" valign="middle"><p><strong>Acciones:</strong>
              
              	<a onclick="eliminarComentario(<?php echo $fila_query2["id"].", '".$fila_query2["nombre"]."'"; ?>)" href="javascript:;">
               		<img src="../../../images/eliminar_16.png" width="16" height="16" border="0" title="Eliminar comentario" />
               </a></p></td>
            </tr>
          <tr<?php echo alt($zebra); $zebra++; ?>>
            <td colspan="2">
              <p><?php echo $fila_query2["contenido"]; ?></p></td>
            </tr>
          <tr>
            <td colspan="2"><hr /></td>
            </tr>
          <?php } ?>
          </table></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <?php 
            if ($_REQUEST["btnbuscar"]=="")
            {
                if (!isset($_GET["pag"]))
                $pag = 1;
                else
                $pag = $_GET["pag"];
                echo paginarComentario($pag, $num_registros, $registros, "$url?pag=", 10);
            }
        ?>
      </td>
        </tr>
        <tr>
          <td height="30" align="center"><?php echo $mensaje2; ?></td>
        </tr>
      </table>
    </div>
          </div><!--FIN PANEL DER-->
        </div><!--FIN INTERIOR-->
    </div><!--FIN CUERPO-->
</div>
</body>
</html>