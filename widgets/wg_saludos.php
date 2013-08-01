<?php
//SALUDOS
$rst_saludos=mysql_query("SELECT * FROM iev_saludos WHERE id>0 AND estado_saludo='A' ORDER BY fecha DESC", $conexion);
$num_saludos=mysql_num_rows($rst_saludos);
?>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="libs/marquee/jquery.marquee.min.js"></script>
<link type="text/css" href="libs/marquee/jquery.marquee.css" rel="stylesheet" title="default" media="all" />
<script type="text/javascript">
var jmarq = jQuery.noConflict();
	jmarq(document).ready(function (){
	  jmarq("#marquee1").marquee({
		  pauseSpeed: 8000,
		  fxEasingShow: "swing",
		  fxEasingScroll: "linear"
	  });
	});
</script>
<link href="../libs/marquee/jquery.marquee.css" rel="stylesheet" type="text/css" />
<div id="panel_saludos" class="limpiar">
	<h3 class="texto_t14 texto_cursiva texto_bold texto_amarillo">
    	<a href="saludos">Envía tu saludo aquí</a></h3>
    <div id="psald_info">
    	<ul id="marquee1" class="marquee">
        	<?php while($fila_saludos=mysql_fetch_array($rst_saludos)){ ?>
            <li><strong><?php echo $fila_saludos["nombre"]; ?>: </strong><?php echo $fila_saludos["contenido"]; ?></li>
            <?php } ?>
        </ul>
    </div>
</div>