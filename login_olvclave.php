<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VERIFICACION DE USUARIO
$proceso=$_POST["uslogin_proc"];
if($proceso=="recuperar"){
	$email=$_POST["uslogin_email"];
	$rst_uslogin=mysql_query("SELECT * FROM iev_usuarios_web WHERE email='$email' LIMIT 1;", $conuserweb);
	$num_uslogin=mysql_num_rows($rst_uslogin);
	if($num_uslogin==1){
		$fila_uslogin=mysql_fetch_array($rst_uslogin);
		//VARIABLES
		$nombre=$fila_uslogin["nombre"]." ".$fila_uslogin["apellidos"];
		$emailver=$fila_uslogin["email"];
		$pass=codigoAleatorio(9,true,true,false);
				
		//CAMBIAR POR CONTRASEÑA TEMPORAL
		mysql_query("UPDATE iev_usuarios_web SET password='".md5($pass)."' WHERE email='$emailver';", $conuserweb);
				
		//ENVAIR AL CORREO
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
		<p>Hola <strong>'.$nombre.'</strong>,</p>
		<p>Has solicitado la recuperacion de tu contraseña.</p>
		<p>A continuacion te brindamos un contraseña temporal.</p>
		<p>Contraseña: <strong>'.$pass.'</strong></p>
		<p><a href="'.$web.'login" target="_blank">Inicia sesión</a> con esta nueva contraseña, y para cambiar la contraseña, dirigete a la opción Perfil.</p>
		</body>
		</html>';
		
		$from="noreply@impactoevangelistico.net";
		$asunto="Impacto Evangelístico | Recuperación de contraseña";
		$headers= "From: Impacto Evangelístico <".strip_tags($from)."> \r\n";
		$headers.= "MIME-Version: 1.0\r\n";
		$headers.= "Content-Type: text/html; charset=UTF-8\r\n";
	
		mail($email, $asunto, $body, $headers);
				
		$uslogin_msj="Tu contraseña ya fue enviada a tu correo electrónico.";
		
	}else{
		$uslogin_msj="El correo electrónico no esta registrado.";
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
                    Recupera tu contraseña<span class="texto_bold"></span></h2>
                </div>
                <div id="uslogin_contenido">
                	<form action="recuperar" method="post" id="form_login" >
                    	<p class="padding_b10 margin_l30 texto_t14">
                        Ingresa tu correo electrónico para recuperar tu contraseña:</p>
                    	<fieldset>
                        	<label class="texto_bold texto_derecha">Correo electrónico:</label>
                            <input name="uslogin_email" type="text" id="uslogin_email" />
                        </fieldset>
                    	<?php if($uslogin_msj<>""){ ?>
                        <fieldset>
                        	<p class="texto_rojo texto_bold texto_centro">
							<?php echo $uslogin_msj; ?></p>
                        </fieldset>
                        <?php } ?>
                        <fieldset>
                        	<input name="uslogin_btn_enviar" type="submit" id="uslogin_btn_enviar" value=" " />
                            <input name="uslogin_proc" type="hidden" id="uslogin_proc" value="recuperar" />
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
                    <p class="texto_bold padding_l30">- Comentar en diversas noticias</p>
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