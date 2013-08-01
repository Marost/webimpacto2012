<?php
include("../../../conexion/conexion.php");
if (isset($_POST['field']) && isset($_POST['value']))
{
	$field = mysql_real_escape_string($_POST['field']);
	$value = mysql_real_escape_string($_POST['value']);
	$cadbusca="SELECT * FROM ".$tabla_suf."_usuario WHERE $field='$value'";
	$result = mysql_query($cadbusca, $conexion);
	if (!$result){die('Query invalida: ' . mysql_error());}
	$cont=0;
	while ($lin = mysql_fetch_array($result, MYSQL_ASSOC)) {$cont++;}
	if($cont==0){echo 1;}else{echo 0;}

}
mysql_close($conexion);
?>