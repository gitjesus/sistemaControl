<?php

//Archivo de conexi�n

$connect=mysql_connect ("localhost","root","") or die ("Error al conectarse a la base de datos");
mysql_select_db("agenda",$connect) or die ("Error al conectarse a la BD");

//Fin conexi�n

?>