<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//CODIGO DE VERIFICACION
$codverificacion=$_REQUEST["codver"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            Tu carta ya fue enviada<span class="texto_bold"></span></h2>
        </div>
        <div id="uslogin_contenido">
          <div id="uslogin_mensaje">
                <p class="texto_t16">Gracias por escribirnos.</p>
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