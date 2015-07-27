<?php

//Archivo de conexión

$connect=mysql_connect ("localhost","root","") or die ("Error al conectarse a la base de datos");
mysql_select_db("agenda",$connect) or die ("Error al conectarse a la BD");

//Fin conexión

?>