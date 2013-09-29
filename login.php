<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is the page for the user password and username varification
##################################################################*/

?>
<?php
ob_start();
?>
<html>
<title>Login Page</title>
<head>
<!-- css for page layout-->
<style>
.login
{
padding-left:300px;
padding-top:100px;


}
.logint
{
padding-left:50px;
padding-top:50px;
padding-right:50px;
padding-bottom:50px;


}
</style>

<!-- javascript for validation -->

<script language="javascript">
function checkfield()
{
if(document.loginform.username.value=="")
{
alert("please insert User name !")
document.loginform.username.focus()
return false
}
if(document.loginform.password.value=="")
{
alert("please insert Password !")
document.loginform.password.focus()
return false
}
}
</script>
</head>
<body bgcolor ="#fcdfcd">
<P><b style="font-size:30px">THE PRODUCT STORE</b></P>
<form name="loginform" action="" method="post">
<div class="login"><table bgcolor="#FFFFFF" class="logint">
<tr>
<td><b>Username</b></td>
<td><input type="text" name="username" ></td>
</tr>
<tr>
<td><b>Password</b></td>
<td><input type="password" name="password"></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" value="submit" name="submit" onClick="return checkfield();"></td>
</tr>
</table>
</div>
</form>
<?php
if(isset($_POST["submit"]))
{

include("config.php");//include database configuration file
$uname=$_POST["username"];
$pword=$_POST["password"];

$query="select id from admin where username='$uname' and password='$pword' ";//query for varification of user name and password
$result=mysql_query($query) or die(mysql_error());
$data=mysql_fetch_array($result);
$id=$data["id"];
if($id)
{
session_start();
$_SESSION["valide_user"]=$uname;
$_SESSION["valide_password"]=$pword;
header("location:product_view.php");//redirect product list page
}
else
{
echo "<p align='center'>"."<font color=red >user name and password are not valid"."</font></p>";//message when username and password is wrong
}
}
?>
<p>
<b style="padding-left:10px;">Design and created By Gyaneshwar pardhi</b><br><p style="padding-left:10px;"> 
<b>Mob. No. 09406728367</b>
<b>Email-id:gyaan1334@gmail.com</b>
</p>
</body>
</html>
<?php
ob_end_flush();
?>
