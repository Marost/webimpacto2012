<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//CARTAS
$rst_noticias=mysql_query("SELECT * FROM iev_cartas WHERE estado='A' AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC;", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cartas | Impacto Evangelístico</title>
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

<?php $slide_superior="false"; ?>
<?php include("cabecera.php"); ?>

<div id="contenido">
        
  <div id="cuerpo">
        
        <div id="panel_inferior">
        
        	<div id="pinf_izq" class="padding_10">
            
            <h1 class="texto_t25 texto_azul texto_bold padding_b10">Cartas</h1>
            
            <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
					$id_noticias=$fila_noticias["id"];
					$url_noticias=$fila_noticias["url"];
					$titulo_noticias=$fila_noticias["titulo"];
					$contenido_noticias=$fila_noticias["contenido"];
					$imagen_noticias=$fila_noticias["imagen"];
					$carpeta_imagen_noticias=$fila_noticias["carpeta_imagen"];
			?>
            	<div class="lista_item">
                    <div class="litem_datos ancho_670">
                    	<h2 class="texto_t16 texto_8C272D texto_bold">
							<?php echo stripslashes($titulo_noticias); ?></h2>
                        	<p><?php echo $contenido_noticias; ?></p>
                    </div>
                    
                </div><!-- LISTA ITEM -->
            <?php } ?>
                
            </div><!-- PANEL INFERIOR IZQ -->
            
            <div id="pinf_der">
            
                <?php require_once("widgets/wg_edimpresa.php"); ?>
                
                <?php require_once("widgets/wg_galeria_principal.php"); ?>
                
                <?php require_once("widgets/wg_videos.php"); ?>
                
            </div><!-- PANEL INFERIOR DER -->
            
        </div><!-- PANEL INFERIOR -->
        
    </div><!-- CUERPO -->
    
    <?php include("footer.php"); ?>
    
</div>
</body>
</html>