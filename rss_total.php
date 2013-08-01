<?php
header('Content-type: text/xml; charset="utf-8"', true);
echo '<?xml version="1.0" encoding="utf-8"?>';
include("panel@impacto/conexion/conexion.php");
$resultado=mysql_query("SELECT * FROM iev_noticia ORDER BY id DESC LIMIT 15",$conexion);

// Generamos nuestro documento
echo '<rss version="2.0">';
echo '<channel>
<title>Impacto Evangelístico</title>
<link>http://www.impactoevangelistico.com/</link>
<language>es-CL</language>
<description>Impacto Evangelístico</description>
<generator>Impacto Evangelístico</generator>';

while($row = mysql_fetch_array($resultado))
{
	echo '<item>
	<title>'.stripslashes($row[titulo]).'</title>
	<pubDate>'.$row[fecha_publicacion].'</pubDate> 
	<link>'.$web.'noticia/'.$row[id].'-'.$row[url].'</link>
	<description><![CDATA['.$row[contenido].']]></description>
	</item>';
}
echo '
</channel>
</rss>';
?>