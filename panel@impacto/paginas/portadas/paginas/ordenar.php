<?php
include("../../../conexion/conexion.php");
foreach ($_GET['listItem'] as $position => $item) :
	$sql[] = mysql_query("UPDATE ".$tabla_suf."_portada_paginas SET orden = $position WHERE id = $item", $conexion);
endforeach;
?>