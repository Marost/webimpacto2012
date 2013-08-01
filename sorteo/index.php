<?php
include("../panel@impacto/conexion/conexion.php");
include("../panel@impacto/conexion/funciones.php");

//SORTEO
$rst_sorteo=mysql_query("SELECT * FROM iev_sorteo WHERE fecha_inicio<='$fechaActual' AND fecha_fin>='$fechaActual';", $conexion);
$fila_sorteo=mysql_fetch_array($rst_sorteo);
$num_sorteo=mysql_num_rows($rst_sorteo);
if($num_sorteo==0){
	$sr_err=1;
}elseif($num_sorteo==1){
	$sr_err=2;
}

//SORTEO - VARIABLES
$sorteo_id=$fila_sorteo["id"];
$sorteo_url=$fila_sorteo["url"];

//ERRORES
$sorteo_error=$_REQUEST["e"];
if($sorteo_error==1){
	$sorteo_mensaje="El DNI ya existe.";
}elseif($sorteo_error==2){
	$sorteo_mensaje="El EMAIL ya existe.";
}elseif($sorteo_error==3){
	$sorteo_mensaje="Sus datos se registraron con exito en el sorteo.";
}

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Sorteo</title>
<base href="<?php echo $web; ?>">

<!-- ESTILOS -->
<link href="../css/normalize.css" rel="stylesheet" type="text/css">
<link href="../css/estilos-sorteo.css" rel="stylesheet" type="text/css">
<link href="../css/clases.css" rel="stylesheet" type="text/css">

<!-- SPRY -->
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

</head>

<body>

<section>
	
    <?php if($sr_err==1){ ?>
    <div class="interior">
    
    	<div id="logo"><img src="../imagenes/logo-impacto-bl.png" width="350" height="124"></div>
        
        <div id="formulario"><h1>Todavia no se puede registrar en el sorteo</h1></div>
    	
    </div>
    <?php }elseif($sr_err==2){ ?>
  <div class="interior">
    	
        <div id="logo">
        	
        	<img src="../imagenes/logo-impacto-bl.png" width="350" height="124" alt="Logo">
        
      </div>
        
   	<div id="formulario">
        	
            <?php if($sorteo_error==1){ ?>
   	  <h2><?php echo $sorteo_mensaje; ?></h2>
            <?php }elseif($sorteo_error==2){ ?>
   	  <h2><?php echo $sorteo_mensaje; ?></h2>
            <?php }elseif($sorteo_error==3){ ?>
   	  <h2><?php echo $sorteo_mensaje; ?></h2>
            <?php } ?>
            
      <form action="/sorteo/procesos/sorteo-registro.php" method="post">
                
                <fieldset>
                    <label for="srt_nombre">Nombre:</label>
                  <span id="srpy_srtnombre">
                    <input type="text" name="srt_nombre" id="srt_nombre" size="50">
                  <span class="textfieldRequiredMsg"></span></span>
                </fieldset>
                   
                <fieldset>
                    <label for="srt_email">Email:</label>
                  <span id="sprytextfield3">
                  <input type="text" name="srt_email" id="srt_email" size="50">
                  <span class="textfieldRequiredMsg"></span>
                  <span class="textfieldInvalidFormatMsg">Email no válido.</span></span>
                </fieldset>
                
                <fieldset>
                    <label for="srt_dni">DNI</label>
                  <span id="sprytextfield4">
                  <input name="srt_dni" type="text" id="srt_dni" size="50" maxlength="8">
</span>
                </fieldset>
                
                <fieldset class="texto_derecha padding_t20">
                    <input name="srt_id" type="hidden" id="srt_id" value="<?php echo $sorteo_id; ?>">
                    <input name="srt_url" type="hidden" id="srt_url" value="<?php echo $sorteo_url; ?>">
                    <input name="srt_boton" type="submit" id="srt_boton" value=" ">
                </fieldset>
                
            </form>
            
        </div>
        
    </div>
    <?php } ?>
    
</section>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("srpy_srtnombre");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
</script>
</body>
</html>