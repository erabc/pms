<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################*/
?>

<?php
//configuration for database connectivity
$server="localhost";
$user="root";
$pass="";
$database_name="products";
mysql_connect($server,$user,$pass) or die("unable to connect the server");//for connect to the server
mysql_select_db($database_name)or die("unable to select database");//for select the database
?>