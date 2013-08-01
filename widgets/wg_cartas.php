<?php
//CARTAS
$rst_cartas=mysql_query("SELECT * FROM iev_cartas WHERE estado='A' AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 5", $conexion);
?>
<!-- CARTAS -->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="libs/tinyscrollbar/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript">
var jqcart = jQuery.noConflict();
jqcart(document).ready(function(){
	jqcart('#wg_cartas').tinyscrollbar();
});
</script>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />

<div id="wg_cartas">
    <div id="wgcart_cabecera">
        <h3 class="texto_azul texto_bold texto_t30 float_left padding_r70">NOS ESCRIBEN...</h3>
        <p class="texto_azul texto_t18 texto_bold float_left padding_10">
        	<a href="enviar_carta">Envianos tu carta...</a></p>
        <p class="texto_negro texto_bold float_left padding_15">
        	<a href="cartas">Ver todos...</a></p>
    </div>
    
    <div class="scrollbar">
        <div class="track">
            <div class="thumb">
                <div class="end"></div>
            </div>
        </div>
    </div><!-- SCROLLBAR -->
    
    <div class="viewport">
        <div class="overview">
        	
            <?php while($fila_cartas=mysql_fetch_array($rst_cartas)){ ?>
            <div class="wgcart_item">
                <h2><?php echo stripslashes($fila_cartas["titulo"]); ?></h2>
                <?php echo $fila_cartas["contenido"]; ?>
            </div>
            <?php } ?>
            
        </div>
    </div>
    
</div><!-- WIDGET CARTAS -->