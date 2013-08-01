<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");

$cebra=1;
$url="listar.php";

$rst_usuarios=mysql_query("SELECT * FROM ".$tabla_suf."_usuarios_web ORDER BY nombre ASC", $conuserweb);
$num_usuarios=mysql_num_rows($rst_usuarios);
	
$registros=20;	
$pagina=$_GET["pag"];
if (is_numeric($pagina)){ $inicio=(($pagina-1)*$registros); }
else { $inicio=0; }

$rst_usuarios=mysql_query("SELECT * FROM ".$tabla_suf."_usuarios_web ORDER BY nombre ASC LIMIT $inicio, $registros;", $conuserweb);
$paginas=ceil($num_usuarios/$registros);

//USUARIOS ACTIVOS
$rst_usuarios_act=mysql_query("SELECT * FROM ".$tabla_suf."_usuarios_web WHERE estado='A';", $conuserweb);
$num_usuarios_act=mysql_num_rows($rst_usuarios_act);

//USUARIOS INACTIVOS
$rst_usuarios_inact=mysql_query("SELECT * FROM ".$tabla_suf."_usuarios_web WHERE estado='I';", $conuserweb);
$num_usuarios_inact=mysql_num_rows($rst_usuarios_inact);

if ($num_usuarios==0){
	if ($buscar!=""){ $mensaje2="No hay registros con el nombre de: <b>$buscar</b>"; }
	else{ $mensaje2="No hay registros en la base de datos"; }
}

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
<link href="../../../css/estilo-panel.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style-listas.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function eliminarUsuario(user) {
if(confirm("¿Está seguro de borrar este Usuario?")) {
	document.location.href="eliminar.php?id="+user;
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
            	<h2>Lista - Usuarios: Web</h2>
                <div id="contenido">
                  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                      <td width="28%" height="30" align="center">
                      <p>Usuarios registrado hasta el momento: <strong><?php echo $num_usuarios; ?></strong></p>
                      <p>Activos: <strong><?php echo $num_usuarios_act; ?></strong> | Inactivos: <strong><?php echo $num_usuarios_inact; ?></strong></p>
                      <p><a href="descargar.php">Descargar lista de los usuarios <strong>(usuarios.xls)</strong></a></p>
                      </td>
                      
                    </tr>
                    <tr>
                      <td>
                              <table width="100%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                    <thead>
                        <tr class="titulo-campo">
                            <th width="71%" height="25" align="left"><p>NOMBRE Y APELLIDO</p></th>
                            <th width='19%' align='center'>Estado</th>
                            <th width='10%' height='25' align='center'><p>ACCIONES</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila_usuarios=mysql_fetch_array($rst_usuarios)){
								if($fila_usuarios["estado"]=="A"){ $estado="Activo";
								}elseif($fila_usuarios["estado"]=="I"){ $estado="Inactivo";}
						?>
                        <tr<?php echo alt($zebra); $zebra++; ?>>
                            <td width="71%"><p><?php echo $fila_usuarios["nombre"]; ?> <?php echo $fila_usuarios["apellidos"]; ?></p></td>
                            <td width="19%" align="center"><p><?php echo $estado; ?></p></td>	
                            <td width="10%" align="center">
                                <a href="javascript:;" onclick="eliminarUsuario(<?php echo $fila_usuarios["id"]?>)">
                                    <img src="../../../images/eliminar_16.png" width="16" height="16" title="Eliminar" /></a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                              </table>
                      
                      </td>
                    </tr>
                <tr>
                      <td height="30" align="center">
                      <?php 
if ($_REQUEST["btnbuscar"]==""){
	if (!isset($_GET["pag"])){ $pag = 1;}
	else{$pag = $_GET["pag"];}
	echo paginar($pag, $num_usuarios, $registros, "$url?pag=", 10);
}
?>

<?php 
/*----------- PAGINACION CON SOLO DESTINO ------------------*/
if ($_REQUEST["btnbuscar"]!="" || $_REQUEST["busqueda"]!=""){
	if (!isset($_GET["pag"])){ $pag = 1; }
	else { $pag = $_GET["pag"]; }
	echo paginar2($pag, $num_usuarios, $registros, "$url?pag=", 10);
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