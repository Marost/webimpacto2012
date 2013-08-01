<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");

$cebra=1;
$url="listar.php";
$buscar=$_REQUEST["busqueda"];

if ($_REQUEST["btnbuscar"]==""){
	$rst_usuarios=mysql_query("SELECT * FROM ".$tabla_suf."_usuario ORDER BY usuario ASC;", $conexion);
	$num_usuarios=mysql_num_rows($rst_usuarios);
		
	$registros=20;	
	$pagina=$_GET["pag"];
	if (is_numeric($pagina)){ $inicio=(($pagina-1)*$registros); }
	else { $inicio=0; }
	
	$rst_usuarios=mysql_query("SELECT * FROM ".$tabla_suf."_usuario ORDER BY usuario ASC LIMIT $inicio, $registros;", $conexion);
	$paginas=ceil($num_usuarios/$registros);
}

//----------------------------
//BUSQUEDA

if ($_REQUEST["btnbuscar"]!="" || $_REQUEST["busqueda"]!=""){
	$rst_usuarios=mysql_query("SELECT * FROM ".$tabla_suf."_usuario WHERE usuario LIKE '%$buscar%' ORDER BY usuario ASC;", $conexion);
	$num_usuarios=mysql_num_rows($rst_usuarios);
	
	$registros=20;	
	$pagina=$_GET["pag"];
	if (is_numeric($pagina)){ $inicio=(($pagina-1)*$registros); }
	else { $inicio=0; }
	
	$rst_usuarios=mysql_query("SELECT * FROM ".$tabla_suf."_usuario WHERE usuario LIKE '%$buscar%' ORDER BY usuario ASC LIMIT $inicio, $registros;", $conexion);
	$paginas=ceil($num_usuarios/$registros);
	
}

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
	document.location.href="eliminar.php?usuario="+user;
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
            	<h2>Lista - Usuarios: Administración</h2>
                <div id="contenido">
                  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                      <td width="28%" height="30" align="center">
                      <form id="form1" name="form1" method="get" action="listar.php">
                          <p><strong>Buscar:</strong>
                            <input name="busqueda" type="text" id="busqueda" value="<?php echo $_GET["busqueda"]; ?>" size="50" /> 
                            &nbsp;&nbsp;
                          <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" /></p>
</form></td>
                    </tr>
                    <tr>
                      <td height="30" align="center"><p class="mensaje"><?php echo $mensaje; ?></p></td>
                    </tr>
                    <tr>
                      <td>
                              <table width="100%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                    <thead>
                        <tr class="titulo-campo">
                            <th width="20%" height="25"><p>USUARIO</p></th>
                            <th width="70%" height="25"><p>NOMBRE Y APELLIDO</p></th>
                            <th width='10%' height='25' align='center'><p>ACCIONES</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila_usuarios=mysql_fetch_array($rst_usuarios)){ ?>
                        <tr<?php echo alt($zebra); $zebra++; ?>>
                            <td width="20%"><p><?php echo $fila_usuarios["usuario"]; ?></p></td>
                            <td width="70%"><p><?php echo $fila_usuarios["nombre"]; ?> <?php echo $fila_usuarios["apellidos"]; ?></p></td>	
                            <td width="10%" align="center">
                                    <a href="javascript:;" onclick="eliminarUsuario('<?php echo $fila_usuarios["usuario"]?>')">
                                        <img src="../../../images/eliminar_16.png" width="16" height="16" title="Eliminar" /></a>
                                    <a href="form-modificar.php?usuario=<?php echo $fila_usuarios["usuario"]?>">
                                        <img src="../../../images/editar_16.png" width="16" height="16" /></a>
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