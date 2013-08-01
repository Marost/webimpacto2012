<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VARIABLES DEL URL
$id_columnista=1;
$id_columna=$_REQUEST["idcolumna"];
$url_columna=$_REQUEST["urlcolumna"];

//COLUMNISTA
$rst_columnista=mysql_query("SELECT * FROM iev_columnista WHERE id=$id_columnista LIMIT 1;", $conexion);
$fila_columnista=mysql_fetch_array($rst_columnista);

//COLUMNA
$rst_columna=mysql_query("SELECT * FROM iev_columnista_columna WHERE id=$id_columna AND url='$url_columna' LIMIT 1;", $conexion);
$num_columna=mysql_num_rows($rst_columna);
if($num_columna==0){ header("Location: ".$fila_empresa['web'].""); }
$fila_columna=mysql_fetch_array($rst_columna);

//COLUMNAS DEL COLUMNISTA
$rst_columnas=mysql_query("SELECT * FROM iev_columnista_columna WHERE id<>$id_columna AND columnista=$id_columnista ORDER BY fecha DESC LIMIT 30;", $conexion);

//COMENTARIO NOTICIA
$rst_comentario=mysql_query("SELECT * FROM iev_columnista_columna_comentario WHERE noticia=$id_columna", $conexion);

//COMENTAR NOTICIA
$proceso=$_POST["proceso"];
$url_pagina=$fila_empresa["web"]."columnista/".$id_columnista."/".$url_columnista."/".$id_columna."/".$url_columna;
if($proceso=="comentar"){
	$id_comentario=$_POST["identificador"];
	$nombres_comentario=$_SESSION["userdr16mweb_nombre"]." ".$_SESSION["userdr16mweb_apellidos"];
	$email_comentario=$_SESSION["userdr16mweb_email"];
	$comentario=eliminarTexto($_POST["mensaje"]);
	$fecha_comentario=date('Y-m-d');
	$hora_comentario= date('H:i');
	$rst_guradar_comentario=mysql_query("INSERT INTO iev_columnista_columna_comentario (nombre, email, comentario, fecha, hora, noticia) VALUES ('$nombres_comentario', '$email_comentario', '$comentario', '$fecha_comentario', '$hora_comentario', $id_comentario)", $conexion);	
	header("Location: ".$url_pagina);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo stripslashes($fila_columna["titulo"]); ?>| Impacto Evangelístico</title>
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
                
                <div class="noticia_web">
                    <div class="nw_datos">
                        <h2><?php echo stripslashes($fila_columna["titulo"]); ?></h2>
                    </div>
                    <div class="nw_contenido">
                        <?php echo $fila_columna["contenido"] ?>
                    </div>
                    
                    <div id="panel_comentarios" class="limpiar">
                
            <h4 class="texto_azul texto_t16 texto_bold">Deja tu comentario</h4>
            
            <?php if(isset($userwebdr16_nombre) and  isset($userwebdr16_apellidos) and isset($userwebdr16_email)){ ?>
            
<!-- COMENTARIO -->
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script type="text/javascript">
var jcomt = jQuery.noConflict();
	jcomt(document).ready(function() {
		jcomt("#comentario").validationEngine()
});

//LIMITAR COMENTARIO
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
            
            <form name="comentario" id="comentario" action="<?php echo $url_pagina; ?>" method="post">
            <p id="texto-advertencia"><?php echo errorComentario($_REQUEST["m"]); ?></p>
            <p>
            <textarea name="mensaje" cols="80" rows="6" class="validate[required,length[6,350]] text-input" id="mensaje" onKeyDown="limitText(this.form.mensaje,this.form.countdown,350);" 
            onKeyUp="limitText(this.form.mensaje,this.form.countdown,350);"></textarea><br />
            <span>Caracteres permitidos <strong>
            <input name="countdown" type="text" style="border:none; background:none;" value="350" size="3" readonly id="countdown"></strong></span>
            </p>
            
            <div id="botones_comentarios">
            <input type="submit" name="button" id="button" value="Enviar" />
            <input name="identificador" type="hidden" id="identificador" value="<?php echo $fila_columna["id"]; ?>" />
            <input name="proceso" type="hidden" id="proceso" value="comentar" />
            </div>
            </form>
                 
            <?php }else{ ?>
            <p><a href="login" title="Inicia sesión" class="texto_azul texto_bold">Inicia sesión</a> para poder dejar tu comentario.</p>
            <?php } ?>
                 
            </div><!--FIN PANEL COMENTARIO-->
            
            <div id="lista_comentarios" class="limpiar">
            <h4 class="texto_azul texto_bold texto_t16">Comentarios</h4>
            <?php $cont=1; ?>
            <?php while($fila_comentario=mysql_fetch_array($rst_comentario)){ ?>
            <div class="item_comentario">
            <p class="nombre_comentario"><strong><?php echo $cont."  -|- ".$fila_comentario["nombre"] ?></strong></p>
            <p class="texto_comentario texto_i150"><?php echo $fila_comentario["comentario"] ?></p>
            <p class="fecha_comentario texto_t10 texto_rojo"><?php echo $fila_comentario["fecha"] ?></p>
            </div>
            <?php $cont++;} ?>
            </div><!--FIN LISTA COMENTARIOS-->
                    
                </div><!-- FIN NOTICIA -->
                
                <div id="columnista_barra">
                
                <div id="columnista_info">
                    
                    <div id="colinf_imagen">
                        <a href="editorial">
                        <img src="imagenes/columnistas/<?php echo $fila_columnista["foto"] ?>" height="70" alt="<?php echo $fila_columnista["nombre_completo"] ?>" /></a>
                    </div><!-- FIN FOTO COLUMNISTA -->
                    
                    <div id="colinf_datos">
                        <p><a href="editorial">
                        <?php echo $fila_columnista["nombre"] ?></a></p>
                        <p><a href="editorial">
                        <?php echo $fila_columnista["apellidos"] ?></a></p>
                    </div><!-- FIN DATOS COLUMNISTA -->
                    
                    <div id="colinf_social">
                    
                        <div id="colinfsoc_facebook">
                            <iframe src="http://www.facebook.com/plugins/like.php?app_id=179652262094617&amp;href=<?php echo $web."editorial" ?>&amp;send=false&amp;layout=box_count&amp;width=75&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=60" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:60px;" allowTransparency="true"></iframe>
                        </div><!-- FIN LIKE FACEBOOK COLUMNISTA -->
                        
                        <div id="colinfsoc_twitter">
                            <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $web."editorial" ?>" data-text="<?php echo $fila_columnista["nombre_completo"] ?>" data-count="vertical" data-lang="es">Tweet</a>
							<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                        </div><!-- FIN TWEET TWITTER COLUMNISTA -->
                        
                    </div><!-- FIN SOCIAL COLUMNISTA -->
                    
                </div><!-- FIN INFO COLUMNISTA -->
                
                <div id="columnas_columnista">
                    <div id="columcol_cabecera">Editoriales</div>
                    <div id="columcol_columnas">
                        <?php while($fila_columnas=mysql_fetch_array($rst_columnas)){ ?>
                        <div class="cccolum_item">
                        <p><a href="editorial/<?php echo $fila_columnas["id"]."-".$fila_columnas["url"]; ?>">
                        <?php echo $fila_columnas["titulo"]; ?></a></p>
                        </div>
                        <?php } ?>
                    </div>
                </div><!-- FIN MIS COLUMNAS -->
                
                </div>
                        
            </div><!-- FIN PANEL IZQ -->
                
            <div id="pinf_der">
            
                <?php require_once("widgets/wg_edimpresa.php"); ?>
                
                <?php require_once("widgets/wg_galeria_principal.php"); ?>
                
                <?php require_once("widgets/wg_videos.php"); ?>
                
            </div><!-- PANEL INFERIOR DER -->
            
        </div>
    
    </div><!-- FIN CUERPO -->
    
    <?php require_once("footer.php"); ?>
    
</div><!-- FIN CONTENIDO -->
</body>
</html>