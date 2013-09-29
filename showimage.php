<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is the page for show the image of particular product
##################################################################*/
?>
<?php
ob_start();
session_start();
include("config.php");//include the database configuration file
$vuser=$_SESSION["valide_user"];
$vpass=$_SESSION["valide_password"];
if($vuser and $vpass)//varify the user login
{
$pid= $_REQUEST["id"];//get the product id form the previous page
$query="select product_image from products where product_id=$pid";//query to select the product image name 
$result=mysql_query($query) or die(mysql_error());
$data=mysql_fetch_array($result);
?>

<img src="image/<?php echo $data["product_image"];?> " />
<?php
}
else
{
header("location:login.php");//when wrong access redirect the visitor to the front page
}
ob_end_flush();
?>