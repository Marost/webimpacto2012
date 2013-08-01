<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//CODIGO DE VERIFICACION
$codverificacion=$_REQUEST["codver"];

$rst_codver_act=mysql_query("SELECT * FROM iev_usuarios_web WHERE codverificacion='$codverificacion' AND estado='A';", $conuserweb);
$num_codver_act=mysql_num_rows($rst_codver_act);

if($num_codver_act==0){
	$rst_codver=mysql_query("SELECT * FROM iev_usuarios_web WHERE codverificacion='$codverificacion'", $conuserweb);
	$num_codver=mysql_num_rows($rst_codver);
	
	if($num_codver==1){
		$fila_codver=mysql_fetch_array($rst_codver);
		$rst_codact=mysql_query("UPDATE iev_usuarios_web SET estado='A' WHERE codverificacion='$codverificacion';", $conuserweb);
		session_start();
		$_SESSION["userimpevnmweb_nombre"]=$fila_codver["nombre"];
		$_SESSION["userimpevnmweb_apellidos"]=$fila_codver["apellidos"];
		$_SESSION["userimpevnmweb_email"]=$fila_codver["email"];
		header("Location: ".$web);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex,nofollow" />
<title>Impacto Evangelístico</title>
<base href="<?php echo $web; ?>" />
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

</head>

<body>

<?php require_once("cabecera.php"); ?>

<div id="contenido" class="limpiar">
    
    <div id="cuerpo">
    
		<div id="panel_inferior">
        
<div id="pinf_izq" class="padding_10">

    <div id="usuario_login">
        <div id="uslogin_cabecera">
            <h2 class="texto_azul texto_t22 texto_centro">
            Tu cuenta ya fue confirmada<span class="texto_bold"></span></h2>
        </div>
        <div id="uslogin_contenido">
          <div id="uslogin_mensaje">
                <p class="texto_t16">Si aún no puedes acceder a tu perfil, cambia tu contraseña <a href="recuperar">aquí</a> y luego inicia sesión.</p>
          </div>
        </div>
    </div><!-- FIN PANEL USUARIO LOGIN -->
    
</div><!-- PANEL INFERIOR IZQ -->
            
<div id="pinf_der">

    <?php require_once("widgets/wg_edimpresa.php"); ?>
    
    <?php require_once("widgets/wg_galeria_principal.php"); ?>
    
    <?php require_once("widgets/wg_videos.php"); ?>
    
</div><!-- PANEL INFERIOR DER -->
            
        </div><!-- PANEL INFERIOR -->
        
    </div><!-- FIN CUERPO -->
    
    <?php require_once("footer.php"); ?>
    
</div><!-- FIN CONTENIDO -->
</body>
</html>