<div id="panel_superior">   
    <div class="interior">
        <div id="psup_cabecera">
            <p class="texto_bold texto_blanco">RESALTAMOS - EDICIÓN</p>
        </div><!-- PANEL SUPERIOR CABECERA -->
        
        <div id="psup_contenido">
        
        <?php while($fila_noticia_superior=mysql_fetch_array($rst_noticia_superior)){
                $id_notsup=$fila_noticia_superior["id"];
                $url_notsup=$fila_noticia_superior["url"];
                $titulo_notsup=$fila_noticia_superior["titulo"];
                $contenido_notsup=$fila_noticia_superior["contenido"];
                $imagen_notsup=$fila_noticia_superior["imagen"];
                $carpeta_imagen_notsup=$fila_noticia_superior["carpeta_imagen"];
        ?>
            <div class="psupc_item">
                <div class="psupci_titulo">
                    <h2 class="texto_azul texto_t13 texto_bold">
                        <a href="noticia/<?php echo $id_notsup."-".$url_notsup; ?>">
                            <?php echo $titulo_notsup; ?></a>
                    </h2>
                </div>
                <div class="psupci_imagen">
                    <a href="noticia/<?php echo $id_notsup."-".$url_notsup; ?>">
                    <img src="imagenes/upload/<?php echo $carpeta_imagen_notsup."thumb/".$imagen_notsup; ?>" alt="<?php echo stripslashes($titulo_notsup); ?>" width="226" height="150" /></a></div>
                
                <div class="psupci_social">
                    <div class="psupcis_facebook">
                        <iframe src="http://www.facebook.com/plugins/like.php?app_id=142635105815374&amp;href=<?php echo $web."noticia/".$id_notsup."-".$url_notsup; ?>&amp;send=false&amp;layout=button_count&amp;width=110&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe>
                    </div>
                    
                    <div class="psupcis_coment">
                    	<?php echo contadorComent($id_notsup, $conexion); ?>                    	
                    </div>
                    
                </div>
                
                <div class="psupci_descripcion">
                    <?php echo cortarTextoRH($contenido_notsup,1,0,0); ?>
                </div>
            </div><!-- PANEL SUPERIOR ITEM -->
        <?php } ?>
            
        </div><!-- PANEL SUPERIOR CONTENIDO -->
	</div>
</div><!-- PANEL SUPERIOR -->