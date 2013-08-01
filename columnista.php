<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");
include("panel@impacto/conexion/funcion-paginacion.php");

//VARIABLES DEL URL
$id_columnista=1;
$url="editorial";

//COLUMNISTA SELECCIONADO
$rst_columnista=mysql_query("SELECT * FROM iev_columnista WHERE id=$id_columnista;", $conexion);
$num_columnista=mysql_num_rows($rst_columnista);
if($num_columnista==0){ header("Location: ".$web.""); }
$fila_columnista=mysql_fetch_array($rst_columnista);
$nombre_columnista=$fila_columnista["nombre_completo"];
$foto_columnista=$fila_columnista["foto"];
$descripcion_columnista=$fila_columnista["descripcion"];

//COLUMNA DEL COLUMNISTA SELECCIONADO
$rst_columna=mysql_query("SELECT * FROM iev_columnista_columna WHERE columnista=$id_columnista ORDER BY fecha DESC;", $conexion);
$num_columna=mysql_num_rows($rst_columna);

$registros=15;
$pagina=$_GET["pag"];
if (is_numeric($pagina))$inicio=(($pagina-1)*$registros);
else $inicio=0;

$rst_columna=mysql_query("SELECT * FROM iev_columnista_columna WHERE columnista=$id_columnista ORDER BY fecha DESC LIMIT $inicio, $registros;", $conexion);
$paginas=ceil($num_columna/$registros);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editorial | Impacto Evangelístico</title>
<base href="<?php echo $web; ?>" />
<link rel="image_src" href="<?php echo $web; ?>imagenes/columnistas/<?php echo $foto_columnista; ?>" id="image_src">
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
        
       	  	<div id="columnista">
            	
                <div id="columnista_imagen">
                	<img src="imagenes/columnistas/<?php echo $foto_columnista ?>" height="80" alt="<?php echo $nombre_columnista; ?>" />
              </div>
                <div id="columnista_datos">
                	<h2><?php echo $nombre_columnista; ?></h2>
                    <p><?php echo $descripcion_columnista; ?></p>
                </div>
                <div id="columnista_social">
                
                	<div id="colsoc_facebook">
                		<iframe src="http://www.facebook.com/plugins/like.php?app_id=179652262094617&amp;href=<?php echo $web."editorial" ?>&amp;send=false&amp;layout=box_count&amp;width=75&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=60" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:60px;" allowTransparency="true"></iframe>
                    </div>
                    
                    <div id="colsoc_twitter">
                    	<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $fila_empresa["web"]."editorial" ?>" data-text="<?php echo $fila_columnista["nombre_completo"] ?>" data-count="vertical" data-lang="es">Tweet</a>
						<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                    </div>

                </div>
            	
            </div><!-- FIN COLUMNISTA -->
            
            <div id="columnista_columnas">
            	<div id="ccol_cabecera">Editoriales</div>
                <div id="ccol_columnas">
                <?php while($fila_columna=mysql_fetch_array($rst_columna)){ ?>
                    <div class="columna_item">
                    	<h2><span><?php echo $fila_columna["fecha"] ?></span> | 
                        <a href="editorial/<?php echo $fila_columna["id"]."-".$fila_columna["url"] ?>">
						<?php echo stripslashes($fila_columna["titulo"]) ?></a></h2>
                        <?php echo cortarTexto($fila_columna["contenido"],1,0,450) ?>
                    </div>
                <?php } ?>
                </div>
            </div><!-- FIN COLUMNISTA COLUMNA -->
            
            <div id="paginar_busqueda">
				<?php
                    if (!isset($_GET["pag"])){$pag = 1;}
					else{$pag = $_GET["pag"];}
                    echo paginarNoticias($pag, $num_columna, $registros, "$url/pag=", 10, $buscar);
                ?>
            </div><!--FIN PAGINA BUSQUEDA-->
            
        	        
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