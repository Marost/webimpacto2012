<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VERIFICACION DE USUARIO
$proceso=$_POST["uslogin_proc"];
if($proceso=="registrar"){
	//VARIABLES	
	$nombres=$_POST["uslogin_nombres"];
	$apellidos=$_POST["uslogin_apellidos"];
	$email=$_POST["uslogin_email"];
	$clave=$_POST["uslogin_pass"];
	$reg_fecha=date("Y-m-d");
	$reg_hora=date("H:i");
	$reg_ip=getRealIP();
	$cod_verifcacion=md5($email);
	$estado="I";
	
	//VERIFICACION DE EMAIL
	$rst_uslogin=mysql_query("SELECT * FROM iev_usuarios_web WHERE email='$email' LIMIT 1;", $conuserweb);
	$num_uslogin=mysql_num_rows($rst_uslogin);
	if($num_uslogin==1){
		$uslogin_msj="El correo electrónico ya esta registrado.";
	}elseif($num_uslogin==0){
		mysql_query("INSERT INTO iev_usuarios_web(nombre, apellidos, email, password, registro_fecha, registro_hora, registro_ip, codverificacion, estado) 
		VALUES('$nombres', '$apellidos', '$email', '".md5($clave)."', '$reg_fecha', '$reg_hora', '$reg_ip', '$cod_verifcacion', '$estado')", $conuserweb);
		session_start();
		$_SESSION["userimpevnmweb_codver"]=$cod_verifcacion;
		
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Impacto Evangelístico</title>
	<style type="text/css">
		body{ font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
		body{ margin:0;}
	</style>
	</head>
		<body>
		<p><img src="'.$web.'imagenes/logo.png" height="39" />
		</p>
		<p>Hola <strong>'.$nombres.' '.$apellidos.'</strong>,</p>
		<p>Tu cuenta está casi lista para usar. Para activarla necesitamos confirmar tu correo electrónico.</p>
		<p>Ingresa en el siguiente enlace: 
		<a href="'.$web.'confirma/'.$cod_verifcacion.'" target="_blank">'.$web.'confirma/'.$cod_verifcacion.'</a></p>
		</body>
		</html>';
		
		$from="noreply@impactoevangelistico.net";
		$asunto="Impacto Evangelístico | Confirma registro";
		$headers= "From: Impacto Evangelístico <".strip_tags($from)."> \r\n";
		$headers.= "MIME-Version: 1.0\r\n";
		$headers.= "Content-Type: text/html; charset=UTF-8\r\n";
	
		mail($email, $asunto, $body, $headers);
		
		header("Location: verificar");
	}
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

<!-- SPRY -->
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

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
            Registrate en <span class="texto_bold">Impacto Evangelístico</span></h2>
        </div>
        <div id="uslogin_contenido">
            <form action="registro" method="post" id="form_login" >
                
                <fieldset>
                    <label class="texto_bold texto_derecha">Nombres:</label>
                    <span id="sptitulo">
                    <input name="uslogin_nombres" type="text" id="uslogin_nombres" />
                    <span class="textfieldRequiredMsg padding_l160">Ingrese su nombre</span></span>
                </fieldset>
                
                <fieldset>
                    <label class="texto_bold texto_derecha">Apellidos:</label>
                    <span id="spapellidos">
                    <input name="uslogin_apellidos" type="text" id="uslogin_apellidos" />
                    <span class="textfieldRequiredMsg padding_l160">Ingrese su apellido</span></span>
                </fieldset>
                
                <fieldset>
                    <label class="texto_bold texto_derecha">Correo electrónico:</label>
                    <span id="spemail">
                    <input name="uslogin_email" type="text" id="uslogin_email" />
                    <span class="textfieldRequiredMsg padding_l160">Ingrese su email</span>
                    <span class="textfieldInvalidFormatMsg padding_l160">Email no válido.</span></span>
                </fieldset>
                
              <fieldset>
                    <label class="texto_bold texto_derecha">Contraseña:</label>
                    <input name="uslogin_pass" type="password" id="uslogin_pass" />
              </fieldset>
                
                <fieldset>
                    <label class="texto_bold texto_derecha">Repetir contraseña:</label>
                    <span id="sppass">
                    <input name="uslogin_repass" type="password" id="uslogin_repass" />
                    <span class="confirmRequiredMsg padding_l160"></span>
                    <span class="confirmInvalidMsg padding_l160">No coinciden las contraseñas</span>
                    </span>
                </fieldset>
                
              <?php if($uslogin_msj<>""){ ?>
                <fieldset>
                    <p class="texto_rojo texto_bold texto_centro">
                    <?php echo $uslogin_msj; ?></p>
                </fieldset>
                <?php } ?>
                <fieldset>
                    <input name="uslogin_btn_registro" type="submit" id="uslogin_btn_registro" value=" " />
                    <input name="uslogin_proc" type="hidden" id="uslogin_proc" value="registrar" />
                </fieldset>
            </form>
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
var spryconfirm1 = new Spry.Widget.ValidationConfirm("sppass", "uslogin_pass");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sptitulo");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spapellidos");
var sprytextfield3 = new Spry.Widget.ValidationTextField("spemail", "email");
</script>
</body>
</html>