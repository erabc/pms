<?php
/*###################################################################
           SECURE PRODUCT MANAGEMENT SYSTEM
		   DESIGN & CREATED BY :GYANESHWAR PARDHI
		   MOBILE NO.          :09406728367
           E-Mail ID           :gyaan1334@gmail.com		   
###################################################################
This is the page in which  all the infomtion releted to product show
and you can switch prodcut edit and product add page
###################################################################*/
?>
<?php 
ob_start(); //start output buffer
session_start(); //start session
$vuser=$_SESSION["valide_user"]; //take the vaules from the session
$pword=$_SESSION["valide_password"];
if($vuser and $pword) //proper login
{
?>
<html>
<head>
<title>Product Display </title>
<!--CSS for page layout-->
<style>
.gyaneshwar{
background:#FFFFFF;
width:700px;
margin-left:150px;
margine-top:200px;
padding-bottom:25px;
}
.ptable
{
margin-left:30px;
margin-top:10px;
margin-bottom:0px;
}
</style>
<!--Script for redirect this page to delete page-->
<script language="javascript">
function move()
{
out_box= confirm( "Are you sure to delete the products information ? ")
if(out_box==true)
{
with(document.view)
{
action="delete_mul.php"
submit();
}
}
else
{
with(document.view)
{
action="product_view.php"
submit();
}
}
}
</script>
<!--javascript for pop-up image-->
<script language="javascript">
function openwin(imagename)
{

window.open("showimage.php ? id="+imagename+"","def" ,"scrollbars=yes,height=400,width=400,top="+(screen.height/4)+",left="+screen.width/4)
}
</script>
</head>
<body bgcolor="#fcdfcd">
<p>
<b style="font-size:30px">THE PRODUCT STORE</b>
 <a href="logout.php"><b style="padding-left:700px;">Logout</b></a>
</p>
<?php
include("config.php");//include database configuration file

$query_n="select * from products"; //query for select all the information releted to the porduct
$result_n=mysql_query($query_n) or die(mysql_error());

$trow=mysql_num_rows($result_n);//query for count how many product informaion in the database

//intialise the variable for paging 
$begin=0; //start point
$limit=8;  //limit per page product item
$j=0;
$l=1;


if($_REQUEST["begin"]) //take the value for start point
{
$begin=$_REQUEST["begin"];
}

$query="select * from products limit $begin,$limit   "; // query select the products for view on the page
$result=mysql_query($query) or die(mysql_error());

?>
<div class="gyaneshwar">
<p>
<b style="font-size:18px;margin-right:300px;">Product Display</b> 
<a href="product_add.php"> <b > Add Product</b></a> &nbsp;&nbsp;
<a href="product_view.php"> <b>View Product</b></a>
</p>
<form action="" name="view" method="post">
<table border="1" class="ptable">
<tr>
<th>&nbsp;</th>
<th>Product</th>
<th>Sub-Category</th>
<th>Created</th>
<th colspan="2">optrations</th>
</tr>
<?php $i=1;
while($data=mysql_fetch_array($result)){

$sub_cat=$data["subcat_id"] ;

$query_sc="select subcat_name from subcategory where subcat_id=$sub_cat";//query for select the subcategory name
$result_sc=mysql_query($query_sc) or die(mysql_error());
$data_sc=mysql_fetch_array($result_sc);

?>
<tr>
<td align="center" width="50"><input type="checkbox" name="<?php echo $data["product_id"];?>" <?php if($_REQUEST["cid"]=='check') echo "checked"; if($_REQUEST["cid"]=='uncheck')echo "unchecked";?>></td>
<td  width="150"><a href="javascript:openwin('<?php echo $data["product_id"];?>')"><?php echo $data["product_name"];?></a></td>
<td  width="150"><?php echo $data_sc["subcat_name"];?></td>
<td align="center" width="150"><?php echo $data["uploaded_date"];?></td>
<td align="center"><p style="width:50px;"><?php echo "<a href=\"product_edit.php?id=".$data["product_id"]."\">";?><img  src="edit.png" alt="Edit" title="Edit" height="16" width="16"> </a></p></td>
<td align="center"><p style="width:50px;"><?php echo "<a href=\"delete.php?id=".$data["product_id"]."\">";?><img  src="del.png" alt="Edit" title="Delete" height="16" width="16"></p></a></td>
</tr>

<?php $i++;}?>
</table>
<p style="margin-left:55px;">
<img src="arrow.png"/>
<a href="product_view.php ? cid=check&begin=<?php echo $begin;?>">Check All</a>
<a href="product_view.php ?cid= uncheck&begin=<?php echo $begin;?>">UnCheck All</a>
<select name="delete"  onChange=" return move();">
<option value="0">With selected</option>
<option value="1" >Delete</option>
</select>
&nbsp;&nbsp;&nbsp;

<?php 

echo "[";
for($j=0;$j<$trow;$j=$j+$limit)
{?>
<a href="product_view.php ? begin=<?php echo $j;?>"> <?php
if($j==$begin)
{
echo "<font color=red>".$l."</font>";?></a><?php
}
else
{
echo "<font>".$l."</font>";?></a><?php
}
$l++;
}
echo "]";
?>

<b>Total page-<?php echo $l-1;?></b>
</p>
</form>
</div>

<p>
<b style="padding-left:10px;">Design and created By Gyaneshwar pardhi</b><br><p style="padding-left:10px;"> 
<b>Mob. No. 09406728367</b>
<b>Email-id:gyaan1334@gmail.com</b>
</p>

</body>
</html>
<?
 }
else
{
header("location:login.php"); //redirect when not proper login
}
ob_end_flush(); //close output buffer
?>