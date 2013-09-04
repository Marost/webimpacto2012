<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VARIABLES
$url_web=$web."francais_edition";

//PAGINACION
require("libs/pagination/class_pagination.php");

//INICIO DE PAGINACION
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$rst_edimpresa        = mysql_query("SELECT COUNT(*) as count FROM iev_edicion_pr WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC", $conexion);
$fila_edimpresa       = mysql_fetch_assoc($rst_edimpresa);
$generated      = intval($fila_edimpresa['count']);
$pagination     = new Pagination("25", $generated, $page, $url_web."?page", 1, 0);
$start          = $pagination->prePagination();
$rst_edimpresa        = mysql_query("SELECT * FROM iev_edicion_pr WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT $start, 25", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Portugues Edição | Impacto Evangelístico</title>
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

<?php $slide_superior="false"; include("cabecera.php"); ?>

<div id="contenido">
        
  	<div id="cuerpo">
        <div id="panel_edicion_anterior">
       	  <div id="pedanterior_contenido">
            
            <?php while($fila_edimpresa=mysql_fetch_array($rst_edimpresa)) {		
				$edimpresa_numero=$fila_edimpresa["titulo"];
				$edimpresa_nombre=$fila_edimpresa["nombre_edicion"];
				$edimpresa_imagen=$fila_edimpresa["imagen"];
			?>
            <div class="pedantcont_item">
            <a href="revista_pr/<?php echo $edimpresa_numero; ?>/index.html" target="_blank" title="<?php echo $edimpresa_nombre; ?>">
            <img src="imagenes/revista/<?php echo $edimpresa_imagen; ?>" width="110" height="147" alt="<?php echo $edimpresa_nombre; ?>"  title="<?php echo $edimpresa_nombre; ?>"/></a>
            </div>
            <?php } ?>
           
          </div>

          <div id="edanterior_paginacion">
              <?php $pagination->pagination(); ?>
          </div>
          
        </div>
    </div><!-- CUERPO -->
    
    <?php include("footer.php"); ?>
    
</div>
</body>
</html>