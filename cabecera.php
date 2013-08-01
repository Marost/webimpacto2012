<?php
//MENU
$rst_menu_superior=mysql_query("SELECT * FROM iev_noticia_categoria WHERE id>0 AND id<>11 AND id<>12 ORDER BY orden ASC;", $conexion);

if(isset($_SESSION["userimpevnmweb_nombre"]) and  isset($_SESSION["userimpevnmweb_apellidos"]) and isset($_SESSION["userimpevnmweb_email"])){
	$userimpevnmweb_nombre=$_SESSION["userimpevnmweb_nombre"];
	$userimpevnmweb_apellidos=$_SESSION["userimpevnmweb_apellidos"];
	$userimpevnmweb_email=$_SESSION["userimpevnmweb_email"];
}

?>
<div id="cabecera" class="limpiar">
  	<div class="interior">
    
        <div id="logo">
        	<h1><a href="">Impacto Evangelístico</a></h1></div><!-- LOGO SUPERIOR -->
        
        <div id="wg_social_media">
            <ul id="web_social">
                <li><a href="http://www.youtube.com/user/bethelcomunicaciones" title="Suscribete a nuestro canal" target="_blank" class="ws_youtube">
                    Youtube</a></li>
                <li><a href="http://www.facebook.com/impactoevangelistico" title="Siguenos" target="_blank" class="ws_facebook">
                    Facebook</a></li>
                <li><a href="rss" title="RSS" target="_blank" class="ws_rss">
                    RSS</a></li>
            </ul>
        </div><!-- WG SOCIAL MEDIA -->
        
        <div id="wg_login_texto">
        	<?php
        if(isset($_SESSION["userimpevnmweb_nombre"]) and  isset($_SESSION["userimpevnmweb_apellidos"]) and isset($_SESSION["userimpevnmweb_email"])){
		?>
            <p>Bienvenido <span class="texto_t14 texto_bold">
				<?php echo $userimpevnmweb_nombre; ?></span> <br />
                <a href="perfil">Perfil</a> | <a href="cerrar" >Cerrar sesión</a></p>
         <?php }else{?>
         	<p><a href="registro">Registrese</a> | <a href="login">Iniciar Sesión</a></p>
         <?php } ?>
        </div>
        
        <div id="wg_menu_superior">
            <ul id="ms_items">
                <li><a href="/home" title="Inicio">Inicio</a></li>
                <li><a href="categoria/11/portada">Portada</a></li>
                <li><a href="categoria/12/noticias">Noticias</a></li>
                <li><a href="editorial">Editorial</a></li>
                <?php while($fila_menu_superior=mysql_fetch_array($rst_menu_superior)){
						$url_categoria=$fila_menu_superior["url"];
						$id_categoria=$fila_menu_superior["id"];
						$nombre_categoria=$fila_menu_superior["categoria"];
				?>
                <li><a href="categoria/<?php echo $id_categoria."/".$url_categoria ?>" title="<?php echo $nombre_categoria; ?>">
					<?php echo $nombre_categoria; ?></a></li>
                <?php } ?>
            </ul>
        </div><!-- MENU SUPERIOR -->
        
        <?php if($slide_superior=="true"){ include("widgets/wg_slide_superior.php"); } ?>
    
    </div><!-- INTERIOR -->
    
</div><!-- CABECERA -->