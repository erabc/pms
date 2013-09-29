<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is page for delete multipal selected porduct infomations
#####################################################################*/
?>
<?php
ob_start(); //start output buffer
session_start();//start session

$vuser=$_SESSION["valide_user"];
$vpass=$_SESSION["valide_password"];

if($vuser and $vpass)//check proper login
{

include("config.php");//include database configuration file
?>
<?php 
$query="select product_id from products";
$result=mysql_query($query) or die(mysql_error());

while($data=mysql_fetch_array($result))
{
 $id=$data["product_id"];
 if($_POST["$id"])
 {
 $query_d="DELETE FROM  products WHERE  product_id=$id LIMIT 1";//query for delete product records
 mysql_query($query_d)or die(mysql_error());
 }
}
header("location:product_view.php");//redirect porduct view page after deletion
}
else
{
header("location:login.php");
}
ob_end_flush();
?>