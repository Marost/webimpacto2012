<?php
//SLIDE SUPERIOR
$rst_slide_superior=mysql_query("SELECT * FROM iev_slide_superior WHERE id>0 ORDER BY orden ASC LIMIT 4;", $conexion);
?>
<!-- SLIDE -->
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/slides/slides.min.jquery.js"></script>
<script type="text/javascript" charset="utf-8">
var jsld = jQuery.noConflict();
jsld(function(){
	jsld('#slider_superior').slides({
		play: 7000,
		preload: true,
		preloadImage: 'imagenes/slpreload.gif',
		pagination: false,
		generateNextPrev: false,
		effect: "fade",
		crossfade: true,
		slideSpeed: 350,
		fadeSpeed: 500
	});
	
});
</script>
<link href="css/slider.css" rel="stylesheet" type="text/css" />

<div id="slider_superior" class="limpiar">
	<div class="slides_container">
    	<?php while($fila_slide_superior=mysql_fetch_array($rst_slide_superior)){
				$titulo_slidesup=$fila_slide_superior["titulo"];
				$imagen_slidesup=$fila_slide_superior["imagen"];
				$carpeta_slidesup=$fila_slide_superior["carpeta_imagen"];
		?>
        <div><img src="../imagenes/upload/<?php echo $carpeta_slidesup."".$imagen_slidesup; ?>" alt="<?php echo $titulo_slidesup; ?>" /></div>
        <?php } ?>
    </div><!--FIN CONTAINER-->    
</div><!--FIN SLIDER-->


        