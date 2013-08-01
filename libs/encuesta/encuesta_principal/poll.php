<?php
include("../../../panel@impacto/conexion/conexion.php");
if(!$_POST['poll'] || !$_POST['pollid']){
	$query=mysql_query("SELECT id, ques FROM iev_encuesta_preguntas ORDER BY id DESC LIMIT 1", $conexion);
	while($row=mysql_fetch_assoc($query)){
		echo "<div id='pe_pregunta'>";
		echo $row['ques'];
		echo "</div>";
		$poll_id=$row['id'];
	}
	if($_GET["result"]==1 || $_COOKIE["voted".$poll_id]=='yes'){
		showresults($poll_id);
		exit;
	}
	else{
		$query=mysql_query("SELECT id, value FROM iev_encuesta_opciones WHERE ques_id=$poll_id", $conexion);
		if(mysql_num_rows($query)){
			echo '<div id="pe_opciones" ><form method="post" id="pollform" action="'.$_SERVER['PHP_SELF'].'" >';
			echo '<input type="hidden" name="pollid" value="'.$poll_id.'" />';
			while($row=mysql_fetch_assoc($query)){
				echo '<p><input type="radio" name="poll" value="'.$row['id'].'" id="option-'.$row['id'].'" /> 
				<label for="option-'.$row['id'].'" >'.$row['value'].'</label></p>';
			}
			echo '<p><input type="submit"  value="  Votar  " /></p></form>';
		}
	}
}
else{
	if($_COOKIE["voted".$_POST['pollid']]!='yes'){
		$query=mysql_query("SELECT * FROM iev_encuesta_opciones WHERE id='".intval($_POST["poll"])."'", $conexion);
		if(mysql_num_rows($query)){
			$query="INSERT INTO iev_encuesta_votos(option_id, voted_on, ip) VALUES('".$_POST["poll"]."', '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."')";
			if(mysql_query($query, $conexion))
			{
				setcookie("voted".$_POST['pollid'], 'yes', time()+86400*300);				
			}
			else
				echo "There was some error processing the query: ".mysql_error();
		}
	}
	showresults(intval($_POST['pollid']));
}
function showresults($poll_id){
	global $conexion;
	$query=mysql_query("SELECT COUNT(*) as totalvotes FROM iev_encuesta_votos WHERE option_id IN(SELECT id FROM iev_encuesta_opciones WHERE ques_id='$poll_id')", $conexion);
	while($row=mysql_fetch_assoc($query))
		$total=$row['totalvotes'];
	$query=mysql_query("SELECT iev_encuesta_opciones.id, iev_encuesta_opciones.value, COUNT(*) as votes FROM iev_encuesta_votos, iev_encuesta_opciones WHERE iev_encuesta_votos.option_id=iev_encuesta_opciones.id AND iev_encuesta_votos.option_id IN(SELECT id FROM iev_encuesta_opciones WHERE ques_id='$poll_id') GROUP BY iev_encuesta_votos.option_id", $conexion);
	while($row=mysql_fetch_assoc($query)){
		$percent=round(($row['votes']*100)/$total);
		echo '<div class="pe_item_opciones" ><p>'.$row['value'].' (<em>'.$percent.'%, '.$row['votes'].' votos</em>)</p>';
		echo '<div class="bar ';
		if($_POST['poll']==$row['id']) echo ' yourvote';
		echo '" style="width: '.$percent.'%; " ></div></div>';
	}
	echo "<p>&nbsp;</p>";
	echo '<p>Total de votos: '.$total.'</p>';
}
?>