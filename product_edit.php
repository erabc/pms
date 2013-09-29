<?php
/*############################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
##############################################################################
This is edit page through witch you can update the informaion about the product
##############################################################################*/
?>
<?php ob_start();//start output buffer?>
<html>
<head>
<title>Product Add Page</title>
<!--javascript for refrese page-->

<script language="javascript">
function selectsub_cat(id)
{
with(document.insert)
{
action="product_edit.php ";
submit();
}
}
</script>
<!--CSS for Page Layout-->
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
</head>
<body bgcolor="#fcdfcd">
<p>
<b style="font-size:30px">THE PRODUCT STORE</b>
<a href="logout.php"><b style="padding-left:700px;">Logout</b></a>
</p>
<?php
$id=$_REQUEST["id"];
session_start();//start session
$user=$_SESSION["valide_user"];
$password=$_SESSION["valide_password"];

if($user and $password)//for validation of right login
{
include("config.php");//include database configuration file

$query="select * from category";//query for selection of category
$result=mysql_query($query) or die(mysql_error());

$query_info="select * from products where product_id='$id'";//query for select previous information
$result_info=mysql_query($query_info) or die(mysql_error);
$data_info=mysql_fetch_array($result_info);
$pim=$data_info["product_image"];
$subcat=$data_info["subcat_id"];
$query_subcat="select cat_id from subcategory where subcat_id='$subcat'"; //query for select the cat_id for subcat_id
$result_subcat=mysql_query($query_subcat) or die(mysql_error());
$data_subcat=mysql_fetch_array($result_subcat);

$cat_id= $data_subcat["cat_id"];

if(isset($_POST["category"])){

$cat=$_POST["category"];
$query2="select subcat_id,subcat_name from subcategory where cat_id='$cat'";//query of selection of subcategory
$result2=mysql_query($query2) or die(mysql_error());
}
else
{
$query2="select subcat_id,subcat_name from subcategory where cat_id='$cat_id'";//query of selection of subcategory
$result2=mysql_query($query2) or die(mysql_error());
}
?>
<form name="insert" action="" method="post" enctype="multipart/form-data">
<div class="gyaneshwar">
<p>
<b style="font-size:18px;margin-right:300px;">Product Edit</b> 
<a href="product_add.php"> <b> Add Product</b></a> &nbsp;&nbsp;
<a href="product_view.php"> <b>View Product</b></a>
</p>
<table class="ptable">
<tr>
<td>
<p>Product Category</p>
</td>
<td>
<input type="hidden" name="pid" value="<?php if(!$_POST["category"]){echo $data_info["product_id"];}else {echo $_POST["pid"];}?>"><select name="category"  onChange="return selectsub_cat() ;">
<option value="0">--Select--</option>
<?php while($data=mysql_fetch_array($result)){

if($_POST["category"]==$data["cat_id"]){?>
<option value="<?php echo $data["cat_id"];?>" selected="selected" ><?php echo $data["cat_name"];?></option>
<?php } 
elseif($data["cat_id"]==$data_subcat["cat_id"])
{?>
<option value="<?php echo $data["cat_id"];?>" selected="selected" ><?php echo $data["cat_name"];?></option>
<?php }
else{?>
<option value="<?php echo $data["cat_id"];?>" ><?php echo $data["cat_name"];?></option>
<?php }}?>
</select></td>
</tr>
<tr>
<td><p>Product SubCategory</p></td>
<td><select name="subcategory" >
<option value="0">--select--</option>
<?php while($data2=mysql_fetch_array($result2))
{
if($data2["subcat_id"]==$data_info["subcat_id"]){
?>
<option value="<?php echo $data2["subcat_id"];?>" selected="selected"><?php echo $data2["subcat_name"];?></option>
<?php }
elseif($_POST["subcategory"]==$data2["subcat_id"])
{?>
<option value="<?php echo $data2["subcat_id"];?>" selected="selected"><?php echo $data2["subcat_name"];?></option>
<?php }
else{?>
<option value="<?php echo $data2["subcat_id"];?>"><?php echo $data2["subcat_name"];?></option>
<?php }}?>
</select></td>
</tr>
<tr>
<td>Product Name</td>
<td><input type="text" name="pname" value=" <?php if(!$_POST["category"]){echo $data_info["product_name"];}else {echo $_POST["pname"];}?>"></td>
</tr>
<tr>
<td>Product Price</td>
<td><input type="text" name="pprice" value="<?php if(!$_POST["category"]){echo $data_info["price"];}else echo $_POST["pprice"];?>"></td></tr>
<tr>
<td>Product Discription</td>
<td><textarea name="pdisc"><?php if(!$_POST["category"]){echo $data_info["description"];}else{ echo $_POST["pdisc"];}?></textarea></td>
<tr>
<td>Product Image</td>
  <td><input type="file" name="image"></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" value="Submit" name="pinfoinsert"></td>
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
$pid=$_POST["pid"];
$psub_cat=$_POST["subcategory"];
$pname=$_POST["pname"];
$pprice=$_POST["pprice"];
$pdisc=$_POST["pdisc"];
//echo $pdisc;
//$pudate=date('d/m/Y');
if($_FILES["image"]["name"])//if image is upload
{
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
$pimage= $pid.$formate;
//echo $pimage;
move_uploaded_file($_FILES["image"]["tmp_name"],"image/".$pid.$formate);//upload modified images
$query3="UPDATE products SET 
product_name = '$pname',
subcat_id = '$psub_cat',
price = '$pprice',
description = '$pdisc',
product_image = '$pimage'
 WHERE product_id ='$pid' LIMIT 1 ";//query for updated record
// echo $query3;
mysql_query($query3) or die(mysql_error());
}
else
{
echo("<script language='javascript'>window.alert('file formate is not supported you can only upload .jpg .png .gif .jpeg type file please select correct formate file and submit again !')</script>");
}
}
else//if iamge is not modified
{
//for save old image name in the database
$query_im="select product_image from  products where product_id=$pid";
///echo $query_im;
$result_im=mysql_query($query_im) or die(mysql_error());
$data_im=mysql_fetch_array($result_im);
$pimage=$data_im["product_image"];
//echo $pimage;
$query3="UPDATE products SET 
product_name = '$pname',
subcat_id = '$psub_cat',
price = '$pprice',
description = '$pdisc',
product_image = '$pimage'
 WHERE product_id ='$pid' LIMIT 1 ";//query for updated record
// echo $query3;
mysql_query($query3) or die(mysql_error());
}
}
}
else
{
header("location:login.php");//redirect whien not proper login
} 
ob_end_flush();//CLOSE the output buffer
?>