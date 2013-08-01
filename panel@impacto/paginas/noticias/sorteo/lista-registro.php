<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");

$cebra=1;
$url="lista-registro.php";
$id_sorteo=$_REQUEST["id"];

//SORTEO
$rst_sorteo=mysql_query("SELECT * FROM ".$tabla_suf."_sorteo WHERE id=$id_sorteo;", $conexion);
$fila_sorteo=mysql_fetch_array($rst_sorteo);

//SORTEO - VARIABLES
$sorteo_titulo=$fila_sorteo["titulo"];
$sorteo_ganador=$fila_sorteo["ganador"];

//PARTICIPANTES DEL SORTEO
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_sorteo_registro WHERE sorteo=$id_sorteo ORDER BY fecha_registro DESC;", $conexion);
$num_registros=mysql_num_rows($rst_query);
	
$registros=30;
$pagina=$_GET["pag"];
if (is_numeric($pagina))
$inicio=(($pagina-1)*$registros);
else
$inicio=0;

$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_sorteo_registro WHERE sorteo=$id_sorteo ORDER BY fecha_registro DESC LIMIT $inicio, $registros;", $conexion);
$paginas=ceil($num_registros/$registros);

//CANTIDAD DE REGISTROS
if ($num_registros==0){
	if ($buscar!=""){ $mensaje2="No hay registros con el nombre: <b>$buscar</b>"; }
	else{ $mensaje2="No hay registros en la base de datos"; }
}

//MENSAJE DE ERROR
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css">
<script type="text/javascript">
function eliminarRegistro(registro, sorteo, nombre) {
if(confirm("¿Está seguro de borrar este registro?\n"+nombre)) {
	document.location.href="eliminar-sorteo-registro.php?registro="+registro+"&sorteo="+sorteo;
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
            	<h2><a href="listar.php?id=<?php echo $id_sorteo; ?>">&laquo;&laquo;</a> Sorteo: <?php echo $sorteo_titulo; ?></h2>
    <div id="contenido_total">
    	<div id="mensaje" >        
        	<p class="mensaje"><?php echo $mensaje; ?></p>
        </div>
        <div id="mensaje">
        	<?php if($sorteo_ganador==""){ ?>
        	<strong><p><a href="sorteo-ganador.php?id=<?php echo $id_sorteo; ?>">
            ELEGIR GANADOR DEL SORTEO</a></p></strong>
            <?php }elseif($sorteo_ganador<>""){
				//DATOS GANADOR
				$rst_ganador=mysql_query("SELECT * FROM ".$tabla_suf."_sorteo_registro WHERE dni='$sorteo_ganador'", $conexion);
				$fila_ganador=mysql_fetch_array($rst_ganador);
				//VARIABLES
				$sorteogan_nombre=$fila_ganador["nombre"]." ".$fila_ganador["apellidos"];
				$sorteogan_dni=$fila_ganador["dni"];
			?>
            <p><strong>GANADOR</strong></p>
            <h1><?php echo $sorteogan_nombre; ?></h1>
            <h3><?php echo $sorteogan_dni; ?></h3>
            <?php } ?>
        </div>
        <div id="contenido">
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2">
                      <table width="100%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                        <thead>
                          <tr class="titulo-campo">
                            <th width="91%" height="22" align="left">REGISTRO</th>
                            <th width="9%" height="22" align="center">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($fila=mysql_fetch_array($rst_query)){
							//VARIABLES
							$sorteore_id=$fila["id"];
							$sorteore_nombre=$fila["nombre"]." ".$fila["apellidos"];
							$sorteore_dni=$fila["dni"];
							$sorteore_email=$fila["email"];
							
						?>
                          <tr<?php echo alt($zebra); $zebra++; ?>>
                            <td width="91%">
                            	<p class="texto-azul12-Arial">
                                	<strong><?php echo $sorteore_nombre; ?></strong></p>
                              <p>DNI: <strong><?php echo $sorteore_dni; ?></strong> - 
                              Email: <strong><?php echo $sorteore_email; ?></strong></p></td>
                            <td width="9%" align="center">
                                <a onclick="eliminarRegistro(<?php echo $sorteore_id.", ".$id_sorteo.", '".$sorteore_nombre."'"; ?>);" href="javascript:;">
                                <img src="../../../images/eliminar_16.png" width="16" height="16" title="Eliminar registro" /></a></td>
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