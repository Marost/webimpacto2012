<?php
include("libs/ssdtube/SSDTube.php");

//VIDEO TITULO
$rst_videos_sup=mysql_query("SELECT * FROM iev_videos WHERE id>0 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);
$num_videos_sup=mysql_num_rows($rst_videos_sup);

//VIDEO TITULO
$rst_videos_inf=mysql_query("SELECT * FROM iev_videos WHERE id>0 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);
?>
<?php if($num_videos_sup>0){ ?>
<!-- WIDGET COMENTARIOS VISITAS -->
<script src="js/jquery.tools.min.1.2.5.js"></script>
<script type="text/javascript">
var jcv = jQuery.noConflict();
jcv(function(){
	jcv("#pvid_inferior ul").tabs("#pvid_superior > div", {effect: 'fade', fadeOutSpeed: 400});
});
</script>

<!-- VIDEOS -->
<script src="js/flowplayer-3.2.6.min.js"></script>

<div class="pinfd_item">
                        
    <div id="pvideos">
    
      <div id="pvid_cabecera"><h2 class="texto_bold texto_cursiva">Videos</h2></div>
        
        <div id="pvid_superior">
       		
            <?php while($fila_videos_sup=mysql_fetch_array($rst_videos_sup)){ ?>
                <div>
                    <div class="pvids_imagen">
                    <style type="text/css">
                        .player{ width:290px; height:193px; float:left; cursor:pointer;}
                        .player img{ margin-left:105px; margin-top:56px; }
                    </style>
                    <?php echo 
                        tipoVideo($fila_videos_sup["tipo_video"], 
                        $fila_videos_sup["carpeta_video"],
                        $fila_videos_sup["video"],
                        $fila_videos_sup["imagen"],
                        $fila_videos_sup["carpeta_imagen"]."thumb/",
                        $fila_videos_sup["id"], 290, 193, $web) ?>
                      </div>
                      <div class="pvids_descripcion">
                        <p><?php echo stripslashes($fila_videos_sup["titulo"]); ?></p>
                      </div>
                </div><!-- PANEL VIDEO ITEM LISTA-->
            <?php } ?>
            
        </div><!-- PANEL pvid_SUPERIOR -->
        
        <div id="pvid_inferior">
            
            <ul>
            <?php while($fila_videos_inf=mysql_fetch_array($rst_videos_inf)){
                        $video_inf=$fila_videos_inf["video"];
                        $urlyoutube="http://www.youtube.com/watch?v=".$video_inf;
                        $youtube = new SSDTube();
                        $youtube->identify($urlyoutube, true);
                ?>
                <li>
                    <div class="pvidii_imagen">
                        <?php if($fila_videos_inf["imagen"]==""){ ?>
                        <img src="<?php echo $youtube->thumbnail_1_url; ?>" width="85" height="70" alt="<?php echo $fila_videos_inf["titulo"]; ?>"/>
                        
                        <?php }else{ ?>
                        <img src="imagenes/upload/<?php echo $fila_videos_inf["carpeta_imagen"]."thumb/".$fila_videos_inf["imagen"] ?>" width="85" height="70" alt="<?php echo $fila_videos_inf["titulo"]; ?>" />
                        <?php } ?>
                  </div>
                        
                  <div class="pvidii_contenido">
                        <p><?php echo $fila_videos_inf["titulo"]; ?></p>
                  </div>
                </li>
                <?php } ?>
                
            </ul>
                        
        </div><!-- PANEL pvid_inferior -->
        
    </div><!-- PANEL VIDEOS -->
    
</div><!-- PANEL ITEM -->
<?php } ?>