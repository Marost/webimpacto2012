<?php
function fecha(){
	$meses = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
	$dia = date(j); // devuelve el día del mes
	$dia2 = date(w); // devuelve el número de día de la semana
	$mes = date(n)-1; // devuelve el número del mes
	$ano = date(Y); // devuelve el año
	$fecha = $dias[$dia2]." ".$dia.".".$meses[$mes].".".$ano;
	return $fecha;
}

function fechaPost(){
	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
	$dia = date(j); // devuelve el día del mes
	$dia2 = date(w); // devuelve el número de día de la semana
	$mes = date(n)-1; // devuelve el número del mes
	$ano = date(Y); // devuelve el año
	$fechaPost = $meses[$mes]." ".$dia.", ".$ano;
	return $fechaPost;
}

function fechaAyer(){
	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
	$dia = date(j)-1; // devuelve el día del mes
	$dia2 = date(w); // devuelve el número de día de la semana
	$mes = date(n)-1; // devuelve el número del mes
	$ano = date(Y); // devuelve el año
	$fechaPost = $meses[$mes]." ".$dia.", ".$ano;
	return $fechaPost;
}

function fechaLarga(){
	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
	$dia = date(j); // devuelve el día del mes
	$dia2 = date(w); // devuelve el número de día de la semana
	$mes = date(n)-1; // devuelve el número del mes
	$ano = date(Y); // devuelve el año
	$fecha = $dias[$dia2].", ".$dia." de ".$meses[$mes]." del ".$ano;
	return $fecha;
}
	
function alt ($cebra)
{
	if($cebra/2 == floor($cebra/2)) {
		return ' class="alt"';
	}else{
		return '';
	}
}

function codigoAleatorio($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
	$source = 'abcdefghijklmnopqrstuvwxyz';
	if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if($n==1) $source .= '1234567890';
	if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
	if($length>0){
		$rstr = "";
		$source = str_split($source,1);
		for($i=1; $i<=$length; $i++){
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,count($source));
			$rstr .= $source[$num-1];
		}

	}
	return $rstr;
}

function nombreMes($numero_mes)
{
	switch($numero_mes){
   		case 1: print "Enero"; break;
		case 2: print "Febrero"; break;
		case 3: print "Marzo"; break;
		case 4: print "Abril"; break;
		case 5: print "Mayo"; break;
		case 6: print "Junio"; break;
		case 7: print "Julio"; break;
		case 8: print "Agosto"; break;
		case 9: print "Septiembre"; break;
		case 10: print "Octubre"; break;
		case 11: print "Noviembre"; break;
		case 12: print "Diciembre"; break;
	}
}

function eliminarTexto($cadena){
	$palabras = '<?php, ?>, <script>,</script>, script, php, while, {, }, [, ], mierda, carajo, conchasumare, cojudo, puta, maldita, perra, <html>, </html>, </body>, </body>, <, >, />, <img';
	$palabra = explode(', ',$palabras);
	$palabras = count($palabra);
	$base = 0;
	while($base<$palabras){
		$cadena = str_ireplace($palabra[$base],'',$cadena);
		$base++;
	}
	return $cadena;
}

function eliminarTextoURL($str) { 
    $search = array('&lt;', '&gt;', '&quot;', '&amp;');     
    $str = str_replace($search, '', $str); 
    $search = array('&aacute;','&Aacute;','&eacute;','&Eacute;','&iacute;','&Iacute;','&oacute;','&Oacute;','&uacute;','&Uacute;','&ntilde;','&Ntilde;'); 
    $replace = array('a','a','e','e','i','i','o','o','u','u','n','n'); 
    $search = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ü', 'ü', 'Ñ', 'ñ', '_', '-'); 
    $replace = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'u', 'u', 'n', 'n', ' ', ' '); 
    $str = str_replace($search, $replace, $str); 
    $str = preg_replace('/&(?!#[0-9]+;)/s', '', $str); 
    $search = array(' a ', ' de ', ' con ', ' por ', ' en ', ' y ', ' e ', ' o ', ' u ', ' la ', ' el ', ' lo ', ' las ', ' los ', ' fue ', ' del ', ' se ', ' su ', ' una '); 
    $str = str_replace($search, ' ', strtolower($str)); 
    $str = str_replace($search, $replace, strtolower(trim($str))); 
    $str = preg_replace("/[^a-zA-Z0-9\s]/", '', $str); 
    $str = preg_replace('/\s\s+/', ' ', $str); 
    $str = str_replace(' ', '-', $str); 
    return  $str; 
}

function UserPass($cadena){
	$palabras = "',=,-,<,>";
	$palabra = explode(', ',$palabras);
	$palabras = count($palabra);
	$base = 0;
	while($base<$palabras){
		$cadena = str_ireplace($palabra[$base],'',$cadena);
		$base++;
	}
	return $cadena;
}

function nombreFecha($anio, $mes, $dia){
	$tmeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$nombrefecha = $tmeses[$mes-1]." ".$dia.", ".$anio;
	return $nombrefecha;
}

function nombreFechaTotal($anio, $mes, $dia){
	$tmeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$nombrefecha = $dia." de ".$tmeses[$mes-1]." del ".$anio;
	return $nombrefecha;
}

function getUrlAmigable($s){

    $s = strtolower($s);
    $s = ereg_replace("[áàâãäª@]","a",$s);
    $s = ereg_replace("[éèêë]","e",$s);
    $s = ereg_replace("[íìîï]","i",$s);
    $s = ereg_replace("[óòôõºö]","o",$s);
    $s = ereg_replace("[úùûü]","u",$s);
    $s = ereg_replace("[ç]","c",$s);
    $s = ereg_replace("[ñ]","n",$s);
    $s = preg_replace( "/[^a-zA-Z0-9\-]/", "-", $s );
    $s = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $s);

    return trim($s, '-');
}

function guardarArchivo($carpeta,$archivo){
	if(is_uploaded_file($archivo['tmp_name']))
	{ 
		$fileName=$archivo['name'];
		$uploadDir=$carpeta;
		$uploadFile=$uploadDir.$fileName;
		$num = 0;
		$name = $fileName;
		$extension = end(explode('.',$fileName));     
		$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
		$nombrese=codigoAleatorio(20, false, true, false);
		$todo=$nombrese.".".$extension;
		while(file_exists($uploadDir.$todo))
		{
			$num++;         
			$todo = $nombrese."".$num.".".$extension; 
		}
		$uploadFile = $uploadDir.$todo; 
		move_uploaded_file($archivo['tmp_name'], $uploadFile);  
		return $todo;
	}
}

function actualizarArchivo($carpeta,$archivo,$archivo_actual){
	if($archivo['name']!="")
	{
		if(is_uploaded_file($archivo['tmp_name']))
		{ 
			$fileName=$archivo['name'];
			$uploadDir=$carpeta;
			$uploadFile=$uploadDir.$fileName;
			$num = 0;
			$name = $fileName;
			$extension = end(explode('.',$fileName));     
			$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
			$nombrese=codigoAleatorio(20, false, true, false);
			$todo=$nombrese.".".$extension;
			while(file_exists($uploadDir.$todo))
			{
				$num++;         
				$todo = $nombrese."".$num.".".$extension; 
			}
			$uploadFile = $uploadDir.$todo; 
			move_uploaded_file($archivo['tmp_name'], $uploadFile);  
			$todo;
		}
	}else{
		$todo=$archivo_actual;
		$todo;
	}
	return $todo;
}

function fechaTexto($fecha, $mes){
	$divfecha = $fecha;
	$numero_mes = $mes;
	$partes = explode("-", $divfecha);
	$fechatotal=nombreFecha($partes[0], $numero_mes, $partes[2]);
	echo $fechatotal;
}

function errorComentario($codmensaje){
		if($codmensaje==1){
			$mensaje="El comentario se ingreso satisfactoriamente";
		}elseif($codmensaje==2){
			$mensaje="No se pudo ingresar el comentario, porque lleva el nombre de uno de nuestros columnistas";
		}elseif($codmensaje==3){
			$mensaje="El codigo de seguridad ingresado es incorrecto";
		}
		return $mensaje;
}

function tipoVideo($tipo, $carpeta_video, $video, $imagen, $carpeta_imagen, $identificador, $ancho, $alto, $web){
	if($tipo=='dailymotion'){
		$codigo='<object width="'.$ancho.'" height="'.$alto.'"><param name="movie" value="http://www.dailymotion.com/swf/video/'.$video.'?width=&theme=eggplant&foreground=%23CFCFCF&highlight=%23834596&background=%23000000&additionalInfos=1&hideInfos=1&start=&animatedTitle=&iframe=0&autoPlay=0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/'.$video.'?width=&theme=eggplant&foreground=%23CFCFCF&highlight=%23834596&background=%23000000&additionalInfos=1&hideInfos=1&start=&animatedTitle=&iframe=0&autoPlay=0" width="'.$ancho.'" height="'.$alto.'" allowfullscreen="true" allowscriptaccess="always"></embed></object>';
	}elseif($tipo=='vimeo'){
		$codigo='<iframe src="http://player.vimeo.com/video/'.$video.'?color=ffffff" width="'.$ancho.'" height="'.$alto.'" frameborder="0"></iframe>';
	}elseif($tipo=='youtube'){
		$codigo='<object width="'.$ancho.'" height="'.$alto.'"><param name="movie" value="http://www.youtube.com/v/'.$video.'?fs=1&amp;hl=es_ES&amp;rel=0"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="allowscriptaccess" value="always"></param>
					<param name="wmode" value="transparent"></param>
					<embed src="http://www.youtube.com/v/'.$video.'?fs=1&amp;hl=es_ES&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$ancho.'" height="'.$alto.'"></embed></object>';
	}elseif($tipo=='flv'){
		$codigo='<div class="player" 
					href="'.$web.'video/'.$carpeta_video.''.$video.'"
					style="background:url('.$web.'imagenes/upload/'.$carpeta_imagen.''.$imagen.') no-repeat center;">
					<img src="'.$web.'imagenes/play_large.png" alt="Play this video" />					
				</div>
				<script type="text/javascript">
					flowplayer("div.player", "'.$web.'video/flowplayer-3.2.7.swf");
				</script>';
	}
	return $codigo;
}

function extraerArray($string){ 
    $string = explode(",", $string); 
    $salida = array(); 
    foreach($string as $i){ 
        $i = trim($i); 
        if(!empty($i)) $salida[] = $i; 
    } 
    return $salida; //devuelve un array 
}

function descativadoCasilla($elemento){
	if($elemento==""){$regresa=0;
	}else{$regresa=$elemento;}
	return $regresa;
}

function AnteriorSiguiente($r_actual, $tabla, $conexion, $anterior, $siguiente){
	if($anterior==true){
		$rst_query=mysql_query("SELECT * FROM ".$tabla." WHERE id=".$r_actual."-1 LIMIT 1", $conexion);
	}elseif($siguiente==true){
		$rst_query=mysql_query("SELECT * FROM ".$tabla." WHERE id=".$r_actual."+1 LIMIT 1", $conexion);
	}
	return $fila_query=mysql_fetch_array($rst_query);
}

function AnteriorSiguienteOrden($orden, $campo, $idcampo, $tabla, $conexion, $anterior, $siguiente){
	if($anterior==true){
		$rst_query=mysql_query("SELECT * FROM ".$tabla." WHERE orden=".$orden."-1 AND ".$campo."=".$idcampo." LIMIT 1", $conexion);
	}elseif($siguiente==true){
		$rst_query=mysql_query("SELECT * FROM ".$tabla." WHERE orden=".$orden."+1 AND ".$campo."=".$idcampo." LIMIT 1", $conexion);
	}
	return $fila_query=mysql_fetch_array($rst_query);
}

function cortarTexto($texto, $superior, $inferior, $caracteres){
	$b_superior='<div style="page-break-after: always;">';
	$b_inferior='<span style="display: none;">&nbsp;</span></div>';
	if(ereg($b_superior, $texto) or ereg($b_inferior, $texto)){
		if($superior==1){
			$total=explode($b_superior, $texto);
			return $total[0];}
		if($inferior==1){
			$total=explode($b_inferior, $texto);
			return $total[1];}
	}else{
		if($superior==1){
			$total=substr($texto, 0, $caracteres);
			return $total;}
		if($inferior==1){
			$total=$texto;
			return $total;}
	}
}

function cortarTextoRH($texto, $superior, $inferior, $caracteres){
	$b_superior="<hr />";
	if(ereg($b_superior, $texto)){
		if($superior==1){
			$total=explode($b_superior, $texto);
			return $total[0];}
		if($inferior==1){
			$total=explode($b_superior, $texto);
			return $total[1];}
	}else{
		if($superior==1){
			$total=substr($texto, 0, $caracteres);
			return $total;}
		if($inferior==1){
			$total=$texto;
			return $total;}
	}
}

function fechaCarpeta(){
	$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
	$mes = date(n)-1; // devuelve el número del mes
	$ano = date(Y); // devuelve el año
	$fechaCarpeta = $meses[$mes]."".$ano;
	return $fechaCarpeta;
}

function crearCarpeta(){
	$nombre_carpeta=fechaCarpeta();
	if(!is_dir("../../../../imagenes/upload/".$nombre_carpeta)){
		@mkdir($nombre_carpeta, 0755);
		$carpeta=$nombre_carpeta;
	}else{
		$carpeta=$nombre_carpeta;
	}
	return $carpeta;
}

function getRealIP(){
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\\.[0-9]+\\.[0-9]+\\.[0-9]+)/", $entry, $ip_list) )
         {
            $private_ip = array(
                  '/^0\\./',
                  '/^127\\.0\\.0\\.1/',
                  '/^192\\.168\\..*/',
                  '/^172\\.((1[6-9])|(2[0-9])|(3[0-1]))\\..*/',
                  '/^10\\..*/');

            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
            if ($client_ip != $found_ip){ $client_ip = $found_ip; break;}
         }
      }
   }else{
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }
   return $client_ip;
}

?>