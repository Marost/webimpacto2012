<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VARIABLES
$idnoticia=$_REQUEST["id"];
$urlnoticia=$_REQUEST["url"];

//CATEGORIA
$rst_noticia_categoria=mysql_query("SELECT * FROM iev_noticia_categoria WHERE id=$idnoticia AND url='$urlnoticia';", $conexion);
$fila_noticia_categoria=mysql_fetch_array($rst_noticia_categoria);
$titulo_notcategoria=$fila_noticia_categoria["categoria"];
$num_noticia_categoria=mysql_num_rows($rst_noticia_categoria);
if($num_noticia_categoria==0){ header("Location: ".$web);}

//NOTICIA DE CATEGORIAS
$rst_noticias=mysql_query("SELECT * FROM iev_noticia WHERE categoria=$idnoticia AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 40;", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo stripslashes($titulo_notcategoria); ?> | Impacto Evangelístico</title>
<base href="<?php echo $web; ?>" />
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

<!-- PANEL GOOGLE +1 -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	{lang: 'es-419'}
</script>

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
            
            <h1 class="texto_t25 texto_azul texto_bold padding_b10">
				<?php echo stripslashes($titulo_notcategoria); ?></h1>
            
            <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
					$id_noticias=$fila_noticias["id"];
					$url_noticias=$fila_noticias["url"];
					$titulo_noticias=$fila_noticias["titulo"];
					$contenido_noticias=$fila_noticias["contenido"];
					$imagen_noticias=$fila_noticias["imagen"];
					$carpeta_imagen_noticias=$fila_noticias["carpeta_imagen"];
			?>
            	<div class="lista_item">
                	<?php if($imagen_noticias<>""){ ?>
                	<div class="litem_imagen">
                    	<img src="imagenes/upload/<?php echo $carpeta_imagen_noticias."thumb/".$imagen_noticias; ?>" width="150" alt="<?php echo stripslashes($titulo_noticias); ?>" />
                    </div>
                    <?php } ?>
                    
                    <?php if($imagen_noticias<>""){ ?>
                    <div class="litem_datos">
                    	<h2 class="texto_t16 texto_8C272D texto_bold">
                        	<a href="noticia/<?php echo $id_noticias."-".$url_noticias; ?>">
							<?php echo stripslashes($titulo_noticias); ?></a></h2>
                        <?php echo cortarTextoRH($contenido_noticias,1,0,200); ?>
                    </div>
                    <?php }else{ ?>
                    <div class="litem_datos ancho_670">
                    	<h2 class="texto_t16 texto_8C272D texto_bold">
                        	<a href="noticia/<?php echo $id_noticias."-".$url_noticias; ?>">
							<?php echo stripslashes($titulo_noticias); ?></a></h2>
                        <?php echo cortarTextoRH($contenido_noticias,1,0,200); ?>
                    </div>
                    <?php } ?>
                    
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