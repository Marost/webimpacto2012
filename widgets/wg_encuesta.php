<?php
$rst_encuesta=mysql_query("SELECT * FROM iev_encuesta_preguntas", $conexion);
$num_encuesta=mysql_num_rows($rst_encuesta);
?>
<?php if($num_encuesta<>0){ ?>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript">
var jenc = jQuery.noConflict();
jenc(function(){
	var pollcontainer=jenc('#penc_resultado');
	jenc.get('libs/encuesta/encuesta_principal/poll.php', '', function(data, status){
		pollcontainer.html(data);
		animateResults(pollcontainer);
		pollcontainer.find('#pollform').submit(function(){
			var selected_val=jenc(this).find('input[name=poll]:checked').val();
			if(selected_val!=''){
				jenc.post('libs/encuesta/encuesta_principal/poll.php', jenc(this).serialize(), function(data, status){
					jenc('#pe_opciones').fadeOut(100, function(){
						jenc(this).html(data);
						animateResults(this);
					});
				});
			}
			return false;
		});
	});
	
	function animateResults(data){
		jenc(data).find('.bar').hide().end().fadeIn('slow', function(){
			jenc(this).find('.bar').each(function(){
				var bar_width=jenc(this).css('width');
				jenc(this).css('width', '0').animate({ width: bar_width }, 1000);
			});
		});
	}
	
});
</script>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />

<div class="pinfd_item">
    <div id="panel_encuesta">
        <div id="penc_cabecera"><h2 class="texto_bold texto_cursiva">Encuesta</h2></div>
        <div id="penc_resultado"></div>
    </div><!-- FIN ENCUESTA -->
</div>
<?php } ?>