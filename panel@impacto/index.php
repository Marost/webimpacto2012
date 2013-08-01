<?php include("conexion/conexion.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo utf8_encode($fila_empresa["nombre"]); ?> - Iniciar Sesión</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="principal">
	<div class="texto_regresar" id="superior_regresar">
    	&nbsp;&nbsp;&nbsp;<a href="<?php echo $fila_empresa["web"]; ?>">
        	&lt;&lt; Volver a <?php echo utf8_encode($fila_empresa["nombre"]); ?></a>
    </div><!-- FIN TEXTO REGRESAR -->
    <div id="contenido">
    	<div id="content_login">
        	<div id="img_login">
           	  <img src="../imagenes/logo.png" alt="" width="297" />
			</div><!-- FIN IMAGEN LOGIN -->
            <div id="formulario_login">
<form action="conexion/verificar.php" method="post">
            	<div id="text_login">Nombre de Usuario:</div>
                <div id="input_login"><input name="user" type="text" id="user" /></div>
                <div id="espacio_login"></div>
                <div id="text_login">Contraseña:</div>
                <div id="input_login"><input name="pass" type="password" id="pass" /></div>
                <div id="espacio_login"></div>
                <div id="boton_login"><input name="btn_login" type="image" id="btn_login" src="images/btn_ingresar.jpg"  /></div>
                <div id="mensaje">
                <?php if($_REQUEST["nosesion"]==1){
						echo "Inicie sesión para poder ingresar al Panel";
					}elseif($_REQUEST["nosesion"]==2){
						echo "Usuario o contraseña no son correctos";
					}elseif($_REQUEST["nosesion"]==3){
						echo "Salio correctamente del Panel";
					} ?>
                </div>
            </form>
          </div><!-- FIN FORMULARIO LOGIN -->
        </div><!-- FIN CONTENI LOGIN -->
    </div><!-- FIN CONTENIDO -->
</div><!-- FIN PRINCIPAL -->
</body>
</html>