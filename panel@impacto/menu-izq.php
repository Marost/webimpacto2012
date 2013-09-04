<script type="text/javascript" src="<?php echo $fila_empresa["web"] ?>js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="<?php echo $fila_empresa["web"] ?>js/jscript_jquery.dimensions.js"></script>
<script type="text/javascript" src="<?php echo $fila_empresa["web"] ?>js/jscript_jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo $fila_empresa["web"] ?>js/jscript_jzScrollHorizontalPane.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		if($("#nav")) {
			$("#nav dd").hide();
			$("#nav dt b").click(function() {
				if(this.className.indexOf("clicked") != -1) {
					$(this).parent().next().slideUp(200);
					$(this).removeClass("clicked");
				}
				else {
					$("#nav dt b").removeClass();
					$(this).addClass("clicked");
					$("#nav dd:visible").slideUp(200);
					$(this).parent().next().slideDown(500);
				}
				return false;
			});
		}
	});
</script>

<dl id="nav">

  <dt class="items"><b>Noticias</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/slide_superior/listar.php">
        	Slide Superior</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/noticias/noticias_superior/listar.php">
        	Noticia del Mes</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/noticias/noticias/listar.php">
        	Noticia</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/noticias/categorias/listar.php">
        	Categorias</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/noticias/tags/listar.php">
        	Tags</a></li>
    </ul>
  </dd>
  <dt class="items"><b>Videos</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/videos/form-agregar.php">
        	Agregar</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/videos/listar.php">
        	Listar</a></li>
    </ul>
  </dd>
  <dt class="items"><b>Editorial</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/columnistas/form-agregar.php">
        	Agregar</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/columnistas/listar.php">
        	Listar</a></li>
    </ul>
  </dd>
  <dt class="items"><b>Galeria</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/galeria/form-agregar.php">
        	Agregar</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/galeria/listar.php">
        	Listar</a></li>
    </ul>
  </dd>
  <dt class="items"><b>Portada</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/portadas/noticias/listar.php">
        	Español</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/portadas/noticias_en/listar.php">
        	Ingles</a></li>
      <li>
        <a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/portadas/noticias_fr/listar.php">
          Frances</a></li>
      <li>
        <a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/portadas/noticias_it/listar.php">
          Italiano</a></li>
      <li>
        <a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/portadas/noticias_pr/listar.php">
          Portugues</a></li>
    </ul>
  </dd>
  <dt class="items"><b>Mensajes</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/noticias/cartas/listar_sr.php">
        	Cartas</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/noticias/saludos/listar.php">
        	Saludos</a></li>
    </ul>
  </dd>
  <dt class="items"><b>Encuesta</b></dt>
  <dd>
    <ul class="items">
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/encuesta/form-agregar.php">
        	Agregar</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/encuesta/listar.php">
        	Listar</a></li>
    </ul>
  </dd>
  <div class="espacio"></div>
  <dt class="items"><b>Usuario</b></dt>
  <dd>
    <ul>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/usuarios/administracion/form-agregar.php">
        	Agregar</a></li>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/usuarios/administracion/listar.php">
        	Listar</a></li>
    </ul>
  </dd>
  <div class="espacio"></div>
  <dt class="items"><b>Web</b></dt>
  <dd>
    <ul>
      <li>
      	<a href="<?php echo $fila_empresa["web"]."".$carpeta_admin; ?>/paginas/usuarios/web/listar.php">
        	Usuarios</a></li>
    </ul>
  </dd>
</dl>
<!--FIN MENU NAV-->