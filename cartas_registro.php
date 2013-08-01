<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VERIFICACION DE USUARIO
$proceso=$_POST["uslogin_proc"];
if($proceso=="enviar"){
	$userimpevnmweb_email=$_SESSION["userimpevnmweb_email"];
	$carta_de=$_POST["uslogin_de"];
	$carta_email=$userimpevnmweb_email;
	$carta_mensaje=$_POST["uslogin_carta"];
	$carta_fecha=$fechaActual;
	$carta_estado="I";
	
	//GUARDAR CARTA - ESTADO: INACTIVO
	$rst_guardar=mysql_query("INSERT INTO iev_cartas (titulo, email, contenido, fecha_publicacion, estado) 
	VALUES('$carta_de', '$carta_email', '$carta_mensaje', '$carta_fecha', '$carta_estado')", $conexion);
	
	header("Location:registrar_carta");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Impacto Evangelístico</title>
<base href="<?php echo $web; ?>" />
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

<!-- GOOGLE ANALITYCS -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20229980-10']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

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
            Envianos tu carta</h2>
        </div>
        <div id="uslogin_contenido">
<?php if(isset($userimpevnmweb_nombre) and  isset($userimpevnmweb_apellidos) and isset($userimpevnmweb_email)){ ?>
            
<!-- COMENTARIO -->
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script type="text/javascript">	
//LIMITAR COMENTARIO
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
            
            <form action="enviar_carta" method="post" id="form_login" >
                <fieldset>
                    <label class="texto_bold texto_derecha">De:</label>
                    <input name="uslogin_de" type="text" id="uslogin_de" value="<?php echo $userimpevnmweb_nombre." ".$userimpevnmweb_apellidos; ?>" readonly="readonly" />
                </fieldset>
                <fieldset>
                  <label class="texto_bold texto_derecha">Mensaje:</label>
                  <span id="txt_mensaje">
                  	<textarea name="uslogin_carta" cols="80" rows="10" id="uslogin_carta" onkeydown="limitText(this.form.uslogin_carta,this.form.countdown,500);" onkeyup="limitText(this.form.uslogin_carta,this.form.countdown,500);"></textarea>
                  	<br />
                  	<span class="textareaRequiredMsg padding_l160">Escriba el mensaje de su carta.</span><br />
                  </span>
                  <span class="padding_l160">Caracteres permitidos <strong>
        			<input name="countdown" type="text" style="border:none; background:none;" value="500" size="3" readonly id="countdown"></strong>
                  </span>
                </fieldset>
                <?php if($uslogin_msj<>""){ ?>
                <fieldset>
                    <p class="texto_rojo texto_bold texto_centro">
                    <?php echo $uslogin_msj; ?></p>
                </fieldset>
                <?php } ?>
                <fieldset>
                    <input name="uslogin_btn_enviar" type="submit" id="uslogin_btn_enviar" value=" " />
                    <input name="uslogin_proc" type="hidden" id="uslogin_proc" value="enviar" />
                </fieldset>
            </form>
            <?php }else{ ?>
            	<p class="texto_t18 texto_centro">Para poder enviarnos tu carta, <a href="login" class="texto_azul texto_bold">inicia sesión</a> o <a href="registro" class="texto_azul texto_bold">registrate</a></p>
            <?php } ?>
      </div>
    </div><!-- FIN PANEL USUARIO LOGIN -->
    
</div><!-- PANEL INFERIOR IZQ -->
        
<div id="pinf_der">

    <?php require_once("widgets/wg_edimpresa.php"); ?>
    
    <?php require_once("widgets/wg_galeria_principal.php"); ?>
    
    <?php require_once("widgets/wg_videos.php"); ?>
    
</div><!-- PANEL INFERIOR DER -->

</div><!-- FIN PANEL IZQ -->
        
    </div><!-- FIN CUERPO -->
    
    <?php require_once("footer.php"); ?>
    
</div><!-- FIN CONTENIDO -->
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("txt_mensaje");
</script>
</body>
</html>