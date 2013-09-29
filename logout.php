<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is the page for destroy the session when user logout
##################################################################*/

?>
<?php
ob_start();//start output buffer
session_start();
$vuser=$_SESSION["valide_user"];
$vpass=$_SESSION["valide_password"];
if($vuser and $vpass)
{
unset($_SESSION["valide_user"]);
unset($_SESSION["valide_password"]);
session_destroy();
header("location:login.php");
}
else
{
header("location:login.php");
}
ob_end_flush();//close output buffer
?>