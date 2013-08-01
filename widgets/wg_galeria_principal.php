<?php
//GALERIA PRINCIPAL
$rst_galeria_prin=mysql_query("SELECT * FROM iev_galeria WHERE id>0 ORDER BY id DESC;", $conexion);

//FOTOS DE GALERIA
function fotoGaleria($idgaleria, $conexion){
	$rst_query=mysql_query("SELECT * FROM iev_galeria_slide WHERE id>0 AND noticia=$idgaleria ORDER BY orden ASC;", $conexion);
	return $fila_query=mysql_fetch_array($rst_query);
}

?>
<!-- GALERIA DE FOTOS -->
<link rel="stylesheet" href="css/svwp_style.css" type="text/css" media="screen" /> 
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.slideViewerPro.1.0.js" type="text/javascript"></script>
<script type="text/javascript">
var jgalweb = jQuery.noConflict();
jgalweb(document).ready(function(){
    jgalweb("div#pgaleria").slideViewerPro({
		thumbs: 3, 
		thumbsPercentReduction: 20,
		thumbsTopMargin: 5,
		thumbsRightMargin: 5,
		thumbsBorderWidth: 2,
		thumbsActiveBorderColor: "red",
		thumbsActiveBorderOpacity: 0.5,
		thumbsBorderOpacity: 0,
		buttonsTextColor: "#000",
		typo: true
	});
});
</script>

<!-- SLIDE INFERIOR _ LIGHTBOX -->
<link rel="stylesheet" href="js/lightbox/lightbox.css" type="text/css" media="screen" />
<script src="js/lightbox/prototype.js" type="text/javascript"></script>
<script src="js/lightbox/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="js/lightbox/lightbox.js" type="text/javascript"></script>

<div class="pinfd_item">
    <div id="pgaleria_cabecera">
      <h2 class="texto_bold texto_cursiva">Galería de Imágenes</h2></div>
    <div id="pgaleria_contenido" class="limpiar">
        <div id="pgaleria" class="svwp">
            <ul>
                <?php while($fila_galeria_prin=mysql_fetch_array($rst_galeria_prin)){
                        $fotoGaleria=fotoGaleria($fila_galeria_prin["id"], $conexion);
                ?>
                <li><a href="galeria/<?php echo $fila_galeria_prin["id"]."-".$fila_galeria_prin["url"]; ?>" title="<?php echo $fila_galeria_prin["titulo"]; ?>">
                    <img width="290" height="210" src="imagenes/galeria/<?php echo $fotoGaleria["carpeta"]."thumb/".$fotoGaleria["imagen"]; ?>" alt="<?php echo $fila_galeria_prin["titulo"]; ?>" /></a></li>
                <?php } ?>
            </ul>
        </div><!-- GALERIA WEB GALERIA -->
    </div>
</div>