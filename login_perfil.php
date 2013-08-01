<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VERIFICACION DE USUARIO
$proceso=$_POST["uslogin_proc"];
$email_perfil=$_SESSION["userimpevnmweb_email"];

//EXTRAER DATOS DE USUARIO
$rst_perfil=mysql_query("SELECT * FROM iev_usuarios_web WHERE email='$email_perfil'", $conuserweb);
$fila_perfil=mysql_fetch_array($rst_perfil);

if($proceso=="guardar"){
	//VARIABLES	
	$nombres=$_POST["uslogin_nombres"];
	$apellidos=$_POST["uslogin_apellidos"];
	$clave=$_POST["uslogin_pass"];
	$repclave=$_POST["uslogin_repass"];
	
	mysql_query("UPDATE iev_usuarios_web SET nombre='$nombres', apellidos='$apellidos' WHERE email='$email_perfil';", $conuserweb);
	
	if($clave<>"" and $repclave<>""){
		mysql_query("UPDATE iev_usuarios_web SET password='".md5($clave)."' WHERE email='$email_perfil'", $conuserweb);
	}
	
	header("Location: perfil");
	$uslogin_msj="Los datos se guardaron exitosamente";
}

if(!isset($_SESSION["userimpevnmweb_nombre"]) and !isset($_SESSION["userimpevnmweb_apellidos"]) and !isset($_SESSION["userimpevnmweb_email"])){
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

<!-- VIDEO -->
<script type="text/javascript" src="js/flowplayer-3.2.4.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php require_once("cabecera.php"); ?>

<div id="contenido" class="limpiar">
	
    <div id="cuerpo">
    	<div id="panel_inferior">
          
<div id="pinf_izq" class="padding_10">

    <form action="perfil" method="post" id="form_login" >
        	<div id="usuario_login">
            	<div id="uslogin_cabecera">
                	<h2 class="texto_azul texto_t20 texto_centro">Información Básica <span class="texto_bold"></span></h2>
                </div>
                <div id="uslogin_contenido">
                	                   	
                        <fieldset>
                        	<label class="texto_bold texto_derecha">Nombres:</label>
                        	<span id="sptitulo">
                        	<input name="uslogin_nombres" type="text" id="uslogin_nombres" value="<?php echo $fila_perfil["nombre"] ?>" />
                        	<span class="textfieldRequiredMsg padding_l160">Ingrese su nombre</span></span>
                        </fieldset>
                        
                        <fieldset>
                        	<label class="texto_bold texto_derecha">Apellidos:</label>
                        	<span id="spapellidos">
                        	<input name="uslogin_apellidos" type="text" id="uslogin_apellidos" value="<?php echo $fila_perfil["apellidos"] ?>" />
                        	<span class="textfieldRequiredMsg padding_l160">Ingrese su apellido</span></span>
                        </fieldset>
                        
                        <fieldset>
                        	<label class="texto_bold texto_derecha">Correo electrónico:</label>
                            <input name="uslogin_email" type="text" id="uslogin_email" value="<?php echo $fila_perfil["email"] ?>" readonly="readonly" />
                            
                        </fieldset>
                	
              </div>
          	</div><!-- FIN PANEL USUARIO LOGIN -->
            
            <div id="usuario_login">
            	<div id="uslogin_cabecera">
                	<h2 class="texto_azul texto_t20 texto_centro">Cambiar Contraseña<span class="texto_bold"></span></h2>
                </div>
                <div id="uslogin_contenido">                    	
                  <fieldset>
                      <label class="texto_bold texto_derecha">Contraseña:</label>
                   	  <input name="uslogin_pass" type="password" id="uslogin_pass" />
                  </fieldset>
                        
                  <fieldset>
                    <label class="texto_bold texto_derecha">Repetir contraseña:</label>
                    <span id="sprypass">
                    <input name="uslogin_repass" type="password" id="uslogin_repass" />
                    <span class="confirmInvalidMsg padding_l160">No coinciden las contraseñas</span></span>
                  </fieldset>
                  
				<?php if($uslogin_msj<>""){ ?>
                    <fieldset>
                        <p class="texto_rojo texto_bold texto_centro">
                        <?php echo $uslogin_msj; ?></p>
                    </fieldset>
                <?php } ?>
                  
                  <fieldset>
                        	<input name="uslogin_btn_guardar" type="submit" id="uslogin_btn_guardar" value=" " />
                      <input name="uslogin_proc" type="hidden" id="uslogin_proc" value="guardar" />
                    </fieldset>                	
              </div>
          	</div><!-- FIN PANEL USUARIO LOGIN -->
            </form>
    
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sptitulo");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spapellidos");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("sprypass", "uslogin_pass", {isRequired:false});
</script>
</body>
</html>