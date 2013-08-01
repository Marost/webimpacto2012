<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VERIFICACION DE USUARIO
$proceso=$_POST["uslogin_proc"];
if($proceso=="ingresar"){
	$email=mysql_real_escape_string($_POST["uslogin_email"]);
	$clave=mysql_real_escape_string($_POST["uslogin_pass"]);
	
	//VERIFICACION DE USUARIO INACTIVO
	$rst_uslogin_inact=mysql_query("SELECT * FROM iev_usuarios_web WHERE email='$email' AND password='".md5($clave)."' AND estado='I' LIMIT 1;", $conuserweb);
	$num_uslogin_inact=mysql_num_rows($rst_uslogin_inact);
	
	if($num_uslogin_inact==1){
		$uslogin_msj="Ya se envio a tu correo el enlace para la activacion de tu cuenta.";
	}else{
		//VERIFICACION DE USUARIO ACTIVO
		$rst_uslogin_act=mysql_query("SELECT * FROM iev_usuarios_web WHERE email='$email' AND password='".md5($clave)."' AND estado='A' LIMIT 1;", $conuserweb);
		$num_uslogin_act=mysql_num_rows($rst_uslogin_act);
		if($num_uslogin_act==1){
			$fila_uslogin_act=mysql_fetch_array($rst_uslogin_act);
			session_start();
			$_SESSION["userimpevnmweb_nombre"]=$fila_uslogin_act["nombre"];
			$_SESSION["userimpevnmweb_apellidos"]=$fila_uslogin_act["apellidos"];
			$_SESSION["userimpevnmweb_email"]=$fila_uslogin_act["email"];
		}else{
			$uslogin_msj="El correo electrónico y/o contraseña, no coinciden.";
		}
	}	
}

if(isset($_SESSION["userimpevnmweb_nombre"]) and  isset($_SESSION["userimpevnmweb_apellidos"]) and isset($_SESSION["userimpevnmweb_email"])){
	header("Location: ".$fila_empresa["web"]);
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
            Inicia sesión en <span class="texto_bold">Impacto Evangelístico</span></h2>
        </div>
        <div id="uslogin_contenido">
            <form action="login" method="post" id="form_login" >
                <fieldset>
                    <label class="texto_bold texto_derecha">Correo electrónico:</label>
                    <input name="uslogin_email" type="text" id="uslogin_email" />
                </fieldset>
                <fieldset>
                    <label class="texto_bold texto_derecha">Contraseña:</label>
                    <input name="uslogin_pass" type="password" id="uslogin_pass" />
                </fieldset>
                <?php if($uslogin_msj<>""){ ?>
                <fieldset>
                    <p class="texto_rojo texto_bold texto_centro">
                    <?php echo $uslogin_msj; ?></p>
                </fieldset>
                <?php } ?>
                <fieldset>
                    <input name="uslogin_btn_ingresar" type="submit" id="uslogin_btn_ingresar" value=" " />
                    <input name="uslogin_proc" type="hidden" id="uslogin_proc" value="ingresar" />
                </fieldset>
                <fieldset>
                    <p class="texto_centro texto_azul texto_bold">
                    <a href="recuperar">¿Olvidaste tu contraseña?</a></p>
                </fieldset>
            </form>
      </div>
    </div><!-- FIN PANEL USUARIO LOGIN -->
    
    <div id="usuario_registro_benf">
        <div id="usregbenf_cabecera">
            <p class="texto_rojo texto_bold texto_t20 texto_centro">
            ¿Todavía no te registraste?</p>
        </div>
        <div id="usregbenf_contenido">
            <p>Completá en pocos minutos el formulario de registro y comenzá a participar de nuestro sitio y disfruta de los beneficios como usuario:</p>
          <p class="texto_bold padding_l30">- Acceso a la Revista Virtual</p>
            <p class="texto_bold padding_l30">- Comenta en diversas noticias</p>
<p>Si todavía no lo haces ingresa <a href="registro" class="texto_rojo texto_bold">AQUI</a></p>
        </div>
    </div><!-- FIN PANEL USUARIO BENEFICIOS-->
    
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
</body>
</html>