<?php
session_start();
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");

//VARIABLES
$id_noticia=$_REQUEST["id"];
$url_noticia=$_REQUEST["url"];

//GALERIA
$rst_galeria=mysql_query("SELECT * FROM iev_galeria WHERE id=$id_noticia AND url='$url_noticia';", $conexion);
$fila_galeria=mysql_fetch_array($rst_galeria);
$num_galeria=mysql_num_rows($rst_galeria);

//FOTOS DE GALERIA
$rst_galfotos=mysql_query("SELECT * FROM iev_galeria_slide WHERE noticia=$id_noticia ORDER BY orden ASC;", $conexion);

//MAS GALERIAS
$rst_galeria_todo=mysql_query("SELECT * FROM iev_galeria WHERE id<>$id_noticia ORDER BY id DESC;", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Galeria: <?php echo $fila_galeria["titulo"]; ?> | Impacto Evangelístico</title>
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

<!-- GALERIA DE FOTOS -->
<link rel="stylesheet" href="libs/galleriffic/css/galleriffic-5.css" type="text/css" />
<link rel="stylesheet" href="libs/galleriffic/css/white.css" type="text/css" />
<script type="text/javascript" src="libs/galleriffic/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="libs/galleriffic/js/jquery.history.js"></script>
<script type="text/javascript" src="libs/galleriffic/js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="libs/galleriffic/js/jquery.opacityrollover.js"></script>
<script type="text/javascript">
    document.write('<style>.noscript { display: none; }</style>');
</script>

</head>

<body>
<?php $slide_superior="false"; ?>
<?php include("cabecera.php"); ?>

<div id="contenido">
        
  	<div id="cuerpo" class="margin_0 padding_0">
        
        <div id="panel_galeria" class="limpiar">
        	
            <h2 class="texto_bold texto_azul texto_t30"><?php echo $fila_galeria["titulo"] ?></h2>
        
<div class="navigation-container">
    <div id="thumbs" class="navigation">
        <a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
    
        <ul class="thumbs noscript">
            
            <?php while($fila_galfotos=mysql_fetch_array($rst_galfotos)){ ?>
            <li>
            	<?php 
					$size = GetImageSize('imagenes/galeria/'.$fila_galfotos["carpeta"].''.$fila_galfotos["imagen"].'');
					$altura=$size[1] + 28;
				?>
                <a class="thumb" name="<?php echo $fila_galfotos["id"]; ?>" href="imagenes/galeria/<?php echo $fila_galfotos["carpeta"]."".$fila_galfotos["imagen"] ?>" title="<?php echo $fila_galfotos["titulo"] ?>">
                    <img src="imagenes/galeria/<?php echo $fila_galfotos["carpeta"]."thumb75/".$fila_galfotos["imagen"] ?>" alt="<?php echo $fila_galfotos["titulo"] ?>" />                    
                </a>
                <div class="caption">
                	<?php if($fila_galfotos["titulo"]==""){ ?>
                    	<div class="image-title"><?php echo $fila_galeria["titulo"] ?></div>
                    <?php }else{ ?>
                    	<div class="image-title"><?php echo $fila_galfotos["titulo"] ?></div>
                    <?php } ?>
                    	<div class="image-desc"><?php echo $fila_galeria["contenido"] ?></div>
                </div>
            </li>
            <?php } ?>
            
        </ul>
        <a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>
    </div>
</div>

		<div class="content">
            <div class="slideshow-container" style="height:<?php echo $altura; ?>px;">
                <div id="controls" class="controls"></div>
                <div id="loading" class="loader"></div>
                <div id="slideshow" class="slideshow"></div>
            </div>
            <div id="caption" class="caption-container">
                <div class="photo-index"></div>
            </div>
        </div>
		
        </div><!-- GALERIA -->
        
        <div id="panel_masgalerias">
        	<h3 class="texto_bold texto_azul texto_t20">Nuestras galerías</h3>
            <div id="pgaltd_contenido">
                <ul>
                    <?php while($fila_galeria_todo=mysql_fetch_array($rst_galeria_todo)){
							$idgaltd=$fila_galeria_todo["id"];
							$rst_galtd_fotos=mysql_query("SELECT * FROM iev_galeria_slide WHERE noticia=$idgaltd AND orden=0;", $conexion);
							$fila_galtd_fotos=mysql_fetch_array($rst_galtd_fotos);
					?>
                    <li><a href="galeria/<?php echo $fila_galeria_todo["id"]."-".$fila_galeria_todo["url"] ?>">
                    	<img src="imagenes/galeria/<?php echo $fila_galtd_fotos["carpeta"]."thumb/".$fila_galtd_fotos["imagen"] ?>" />
						<?php echo $fila_galeria_todo["titulo"]; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
    </div><!-- CUERPO -->
    
    <?php include("footer.php"); ?>
    
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('div.content').css('display', 'block');
		var onMouseOutOpacity = 0.67;
		$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
			mouseOutOpacity:   onMouseOutOpacity,
			mouseOverOpacity:  1.0,
			fadeSpeed:         'fast',
			exemptionSelector: '.selected'
		});
		var gallery = $('#thumbs').galleriffic({
			delay:                     2500,
			numThumbs:                 10,
			preloadAhead:              10,
			enableTopPager:            false,
			enableBottomPager:         false,
			imageContainerSel:         '#slideshow',
			controlsContainerSel:      '#controls',
			captionContainerSel:       '#caption',
			loadingContainerSel:       '#loading',
			renderSSControls:          true,
			renderNavControls:         true,
			playLinkText:              'Play',
			pauseLinkText:             'Pausa',
			prevLinkText:              '&lsaquo; Anterior',
			nextLinkText:              'Siguiente &rsaquo;',
			nextPageLinkText:          'Siguiente &rsaquo;',
			prevPageLinkText:          '&lsaquo; Anterior',
			enableHistory:             true,
			autoStart:                 false,
			syncTransitions:           true,
			defaultTransitionDuration: 900,
			onSlideChange:             function(prevIndex, nextIndex) {
				this.find('ul.thumbs').children()
					.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
					.eq(nextIndex).fadeTo('fast', 1.0);
				this.$captionContainer.find('div.photo-index')
					.html('Foto '+ (nextIndex+1) +' de '+ this.data.length);
			},
			onPageTransitionOut:       function(callback) {
				this.fadeTo('fast', 0.0, callback);
			},
			onPageTransitionIn:        function() {
				var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
				var nextPageLink = this.find('a.next').css('visibility', 'hidden');
				if (this.displayedPage > 0)
					prevPageLink.css('visibility', 'visible');
				var lastPage = this.getNumPages() - 1;
				if (this.displayedPage < lastPage)
					nextPageLink.css('visibility', 'visible');
				this.fadeTo('fast', 1.0);
			}
		});
		gallery.find('a.prev').click(function(e) {
			gallery.previousPage();
			e.preventDefault();
		});

		gallery.find('a.next').click(function(e) {
			gallery.nextPage();
			e.preventDefault();
		});
		function pageload(hash) {
			if(hash) {
				$.galleriffic.gotoImage(hash);
			} else {
				gallery.gotoIndex(0);
			}
		}
		$.historyInit(pageload, "advanced.html");
		$("a[rel='history']").live('click', function(e) {
			if (e.button != 0) return true;

			var hash = this.href;
			hash = hash.replace(/^.*#/, '');
			$.historyLoad(hash);
			return false;
		});
	});
</script>

</body>
</html>