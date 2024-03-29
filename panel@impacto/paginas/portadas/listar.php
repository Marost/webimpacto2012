<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");
include("../../conexion/funciones.php");
include("../../conexion/funcion-paginacion.php");

//EMPRESA
$rst_empresa=mysql_query("SELECT * FROM ".$tabla_suf."_empresa WHERE id=1", $conexion);
$fila_empresa=mysql_fetch_array($rst_empresa);

$user=$_SESSION["user-dr16"];
$cebra=1;
$url="listar.php";
$buscar=$_REQUEST["busqueda"];

$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ".$tabla_suf."_portada WHERE id>0 ORDER BY id DESC;", $conexion);
$num_registros=mysql_num_rows($rst_query);
	
$registros=20;	
$pagina=$_GET["pag"];
if (is_numeric($pagina))
$inicio=(($pagina-1)*$registros);
else
$inicio=0;

$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ".$tabla_suf."_portada WHERE id>0 ORDER BY id DESC LIMIT $inicio, $registros;", $conexion);
$paginas=ceil($num_registros/$registros);

if ($num_registros==0)
{
	if ($buscar!="")		
		$mensaje2="No hay registros con el nombre: <b>$buscar</b>";
	else
		$mensaje2="No hay registros en la base de datos";
}


//------- MENSAJE DE ERROR
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
	
//PRIVILEGIOS USUARIO
$rst_prv_user=mysql_query("SELECT * FROM ".$tabla_suf."_usuario_privilegios WHERE usuario='$user';", $conexion);
$fila_prv_user=mysql_fetch_array($rst_prv_user);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css">
<script type="text/javascript">
function eliminarRegistro(registro, nombre) {
if(confirm("¿Está seguro de borrar este registro?\n"+nombre)) {
	document.location.href="eliminar.php?id="+registro;
	}
}
</script>
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
            	<h2>Lista - Portada</h2>
    <div id="contenido_total">
    	<div id="mensaje" class="mensaje">
        	<p><?php echo $mensaje; ?></p>
        </div>
        <div id="contenido">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2">
                  <table width="100%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                    <thead>
                      <tr class="titulo-campo">
                        <th width="85%" height="22" align="left">FECHA PORTADA </th>
                        <th width="15%" height="22" align="center">acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($fila=mysql_fetch_array($rst_query)){ ?>
                      <tr<?php echo alt($zebra); $zebra++; ?>>
                        <td width="85%">
                            <p><strong class="up"><?php echo $fila["fecha2"]; ?></strong></p></td>
                        <td width="15%" align="center">
                        <?php if($fila_prv_user["portada_eliminar"]==1){ ?>
                            <a onclick="eliminarRegistro(<?php echo $fila["id"] ?>, '<?php echo stripslashes(htmlspecialchars($fila["fecha"])) ?>');" href="javascript:;">
                            <img src="../../images/eliminar_16.png" width="16" height="16" title="Eliminar registro" /></a>
                        <?php } ?>
                        <?php if($fila_prv_user["portada_modificar"]==1){ ?>
                        <a href="form-modificar.php?id=<?php echo $fila["id"] ?>">
                            <img src="../../images/editar_16.png" width="16" height="16" /></a>
                        <?php } ?>
                        <?php if($fila_prv_user["portada_comentarios"]==1){ ?>
                            <a href="comentarios.php?id=<?php echo $fila["id"] ?>"><img src="../../images/comentario.png" width="16" height="16" title="Ver comentarios" /></a>
                        <?php } ?>
                        <a href="paginas/listar.php?portada=<?php echo $fila["id"] ?>">
                        <img src="../../images/pag_16.png" width="16" height="16" alt="Paginas" title="Ver paginas" />
                        </a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30" colspan="2" align="center">
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