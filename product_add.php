<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is the page for insert new product information
##################################################################*/
?>
<?php ob_start();//start output buffer?>
<html>
<head>
<title>Product Add Page</title>
<!--CSS for page layout-->
<style>
.gyaneshwar{
background:#FFFFFF;
width:700px;
margin-left:150px;
margine-top:200px;
}
.ptable
{
margin-left:155px;
margin-top:10px;
margin-bottom:30px;
}
</style>
<!-- java scripts for validation -->
<script language="javascript">
function checkfield()
{
if(document.insert.category.value==0)
{
alert("please  select category !")
document.insert.category.focus()
return false
}
if(document.insert.subcategory.value==0)
{
alert("please select subcategory !")
document.insert.subcategory.focus()
return false
}
if(document.insert.pname.value=="")
{
alert("please insert product name !")
document.insert.pname.focus()
return false
}
if(document.insert.pprice.value=="")
{
alert("please insert product pirce !")
document.insert.pprice.focus()
return false
}
if(document.insert.pdisc.value=="")
{
alert("please insert product descreaption ")
document.insert.pdisc.focus()
return false
}
if(document.insert.image.value=="")
{
alert("please insert image for product")
document.insert.image.focus()
return false
}
}
</script>
<!-- java script for page referce-->
<script language="javascript">
function selectsub_cat()
{
with(document.insert)
{
action="product_add.php";
submit();
}
}
</script>
</head>
<body bgcolor="#fcdfcd">
<?php
session_start();//start session

$user=$_SESSION["valide_user"];
$password=$_SESSION["valide_password"];

if($user and $password)//for validation of right login
{
include("config.php");//include database configuration file

$query="select * from category";//query for selection of category
$result=mysql_query($query) or die(mysql_error());

if(isset($_POST["category"])){
$cat=$_POST["category"];
$query2="select subcat_id,subcat_name from subcategory where cat_id=$cat";//query of selection of subcategory
$result2=mysql_query($query2) or die(mysql_error());
}
?>
<form name="insert" action="" method="post" enctype="multipart/form-data">
<p><b style="font-size:30px">THE PRODUCT STORE</b> 
<a href="logout.php"><b style="padding-left:700px;">Logout</b></a>
</p>
<div class="gyaneshwar">
<p>
<b style="font-size:18px; margin-right:300px;">Product Add</b>  
<a href="product_add.php"><b> Add Product</b></a> &nbsp;&nbsp;
<a href="product_view.php"> <b>View Product</b></a>
</p>
<table class="ptable">
<tr>
<td><p>Product Category</p></td>
<td><select name="category"  onChange="return selectsub_cat();">
<option value="0">--Select--</option>
<?php while($data=mysql_fetch_array($result)){
if($_POST["category"]==$data["cat_id"]){?>
<option value="<?php echo $data["cat_id"];?>" selected="selected" ><?php echo $data["cat_name"];?></option>
<?php } else{?>
<option value="<?php echo $data["cat_id"];?>" ><?php echo $data["cat_name"];?></option>
<?php 
}
}?>
</select></td>
</tr>
<tr>
<td><p>Product SubCategory</p></td>
<td><select name="subcategory" >
<option value="0">--select--</option>
<?php while($data2=mysql_fetch_array($result2))
{?>
<option value="<?php echo $data2["subcat_id"];?>"><?php echo $data2["subcat_name"];?></option>
<?php }?>
</select></td>
</tr>
<tr><td>Product Name</td>
<td><input type="text" name="pname"></td>
</tr>
<tr><td>Product Price</td>
<td><input type="text" name="pprice"></td>
</tr>
<tr>
<td>Product Discription</td>
<td><textarea name="pdisc"></textarea></td>
</tr>
<tr>
<td>Product Image</td>
<td><input type="file" name="image"></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" value="Sumit" name="pinfoinsert" onClick="return checkfield();"></td>
</tr>
</table>
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

if(isset($_POST["pinfoinsert"]))
{
$psub_cat=$_POST["subcategory"];
$pname=$_POST["pname"];
$pprice=$_POST["pprice"];
$pdisc=$_POST["pdisc"];
$pimage=$_POST["image"];
$pudate=date('d/m/Y');
$pimage_type=$_FILES["image"]["type"];
if($pimage_type=='image/jpeg' or $pimage_type=='image/jpg' or $pimage_type=='image/gif' or $pimage_type=='image/png')//for check the image type file extension
{
if($pimage_type=='image/jpeg')
{
$formate=".jpeg";
}
if($pimage_type=='image/jpg')
{
$formate=".jpg";
}
if($pimage_type=='image/gif')
{
$formate=".gif";
}
if($pimage_type=='image/png')
{
$formate=".png";
}

$query3="insert into products (product_name,subcat_id,price,description,product_image,uploaded_date)values('$pname',$psub_cat,'$pprice','$pdisc','$pimage','$pudate')";
mysql_query($query3) or die(mysql_error());//query for insert the record


$id= mysql_insert_id();//query for take the last porduct id value

move_uploaded_file($_FILES["image"]["tmp_name"],"image/".$id.$formate);//uplaod the image in the image folder 
$id_image=$id.$formate;
$query_image= "update products set product_image='$id_image' where  product_id=$id";
mysql_query($query_image) or die(mysql_error());//query for insert the image names
}
else
{
echo("<script language='javascript'>window.alert('file formate is not supported you can only upload .jpg .png .gif .jpeg type file please select correct formate file and submit again !')</script>");
}
}
}
else
{
header("location:login.php");//redirect when not proper login
} 
ob_end_flush();//close output buffer
?>