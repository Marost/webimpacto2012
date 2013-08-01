<div id="cabecera" class="limpiar">
    <div class="interior">
        <div class="logo-superior">
        	<img src="<?php echo $fila_empresa["web"] ?>/imagenes/logo.png" height="40" alt="Logo" /></div><!--FIN LOGO SUPERIOR-->
        <div class="usuario-sesion">
        <p>Usuario: <strong><?php echo $usuario_nombre." ".$usuario_apellido; ?></strong> | 
        <a href="<?php echo $fila_empresa["web"]."".$carpeta_admin ?>/conexion/salir.php">Cerrar sesión</a></p>
        </div><!--FIN USUARIO SESION-->
  </div><!--FIN INTERIOR-->
</div><!--FIN CABECERA-->