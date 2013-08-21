<?php
//EDICION IMPRESA
$rst_edimpresa=mysql_query("SELECT * FROM iev_edicion WHERE fecha_publicacion<='$fechaActual' ORDER BY id DESC", $conexion);
$fila_edimpresa=mysql_fetch_array($rst_edimpresa);
$edimpresa_numero=$fila_edimpresa["titulo"];
$edimpresa_nombre=$fila_edimpresa["nombre_edicion"];
$edimpresa_imagen=$fila_edimpresa["imagen"];
?>
<div class="pinfd_item">
    <div id="pedicion_mes">
        <div id="pedmes_cabecera"><h2 class="texto_bold texto_cursiva">Edición del mes</h2></div>
        <div id="pedmes_contenido" style="text-align:center;">
        <a href="/revista/<?php echo $edimpresa_numero; ?>/index.html" target="_blank">
        	<img src="imagenes/revista/<?php echo $edimpresa_imagen; ?>" width="239" alt="Portada" title="<?php echo $edimpresa_nombre; ?>"></a>
        <a href="edicion_anterior" target="_blank">
       	  <img class="padding_t10" src="/imagenes/edimpreso_anterior.jpg" alt="Edición Anterior" width="290" height="22" border="0" /></a></div>
    </div><!-- PANEL EDICION MES -->
</div><!-- PANEL ITEM -->
