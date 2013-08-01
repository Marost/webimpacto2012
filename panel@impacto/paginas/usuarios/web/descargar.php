<?php
include ("../../../conexion/conexion.php");

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");

$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_usuarios_web ORDER BY nombre ASC", $conuserweb);

echo "<table>\n";
echo "<tr>\n";
echo "<th>Email</th>\n";
echo "<th>Nombre</th>\n";
echo "<th>Apellido</th>\n";
echo "</tr>\n";

while ($row = mysql_fetch_array($rst_query))
{
	echo "<tr>\n";
	echo "<td>".$row['email']."</td>\n";
	echo "<td>".$row['nombre']."</td>\n";
	echo "<td>".$row['apellidos']."</td>\n";
	echo "</tr>\n";
}
echo "</table>\n";

?>