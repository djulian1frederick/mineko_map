<?php
	$user = 'root_mysql';
	$password = 'Terr@n0saur';
	$host = 'localhost';
	$db = 'mineco_map';

$bd = mysqli_connect($host,$user,$password,$db) OR DIE("Не могу создать соединение "); 
$db_select = mysqli_select_db($bd, $db); 
if (!$db_select) { 
die("Database selection failed: " . mysqli_error()); 
mysqli_query('SET names "utf8"'); 
} 


?>