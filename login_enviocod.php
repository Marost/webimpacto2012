<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

if(!isset($_SESSION["userimpevnmweb_codver"])){
	header("Location: ".$web);
}

if(isset($_SESSION["userimpevnmweb_nombre"]) and  isset($_SESSION["userimpevnmweb_apellidos"]) and isset($_SESSION["userimpevnmweb_email"])){
	header("Location: ".$web);
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
            <h2 class="texto_azul texto_t28 texto_centro">
            Bienvenido a <span class="texto_bold">Impacto Evangelístico</span></h2>
        </div>
        <div id="uslogin_contenido">
          <div id="uslogin_mensaje">
                <p class="texto_t16">Tu cuenta está casi lista para usar. Ahora solo tienes que revisar tu correo electrónico para activarla.</p>
          </div>
      </div>
    </div><!-- FIN PANEL USUARIO LOGIN -->

</div><!-- PANEL INFERIOR IZQ -->
      
        
    <div id="pinf_der">
    
        <?php require_once("widgets/wg_edimpresa.php"); ?>
        
        <?php require_once("widgets/wg_galeria_principal.php"); ?>
        
        <?php require_once("widgets/wg_videos.php"); ?>
        
    </div><!-- PANEL INFERIOR DER -->
</div>
        
    </div><!-- FIN CUERPO -->
    
    <?php require_once("footer.php"); ?>
    
</div><!-- FIN CONTENIDO -->
</body>
</html>