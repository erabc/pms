<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is the page for delete single product information
##################################################################*/
?>
<?php
ob_start();
session_start();
$vuser=$_SESSION["valide_user"];
$vpass=$_SESSION["valide_password"];
if($vuser and $vpass)
{
include("config.php");//include database configuration file
?>
<html>
<head>
<title>Delete Confromation</title>
</head>
<body>
<?php
session_start();//start session
$vuser=$_SESSION["valide_user"];
$pword=$_SESSION["valide_password"];
$id=$_REQUEST["id"];
if($vuser and $pword)//for check proper login
{
?>
<p>
<b>Do You Realy Want ot delete Product ? </b>
</p>
<form name="con_del" action="" method="post">
<div>
<input type="submit" name="ndelete" value="NO"> 
<input type="submit" name="ydelete" value="YES">
</div> 
</form>
<p>
<b style="padding-left:10px;">Design and created By Gyaneshwar pardhi</b><br><p style="padding-left:10px;"> 
<b>Mob. No. 09406728367</b>
<b>Email-id:gyaan1334@gmail.com</b>
</p>
</body>
</html>
<?php 
}
if(isset($_POST["ndelete"]))
{
header("location:product_view.php");
}
if(isset($_POST["ydelete"]))
{
$query="DELETE FROM  products WHERE  product_id= $id LIMIT 1";
mysql_query($query) or die(mysql_error());
header("location:product_view.php");
}
}
else
{
header("location:login.php");
}
ob_end_flush(); 
?>
