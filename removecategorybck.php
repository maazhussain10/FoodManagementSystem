<?php
session_start();
if(!isset($_SESSION['uname']))
{
	echo "<script>window.location.href='index.php';</script>";
}
if(!isset($_POST['category']))
{
	echo "<script>window.location.href='category.php';</script>";
}
include('dbConnect.php');
$x=$_POST['category'];
$y="category";
$smt=$con->prepare("select * from admin where value=? and category=? ");
$smt->bind_param('ss',$x,$y);
$smt->execute();
$res=$smt->get_result();
if($row=$res->fetch_assoc())
{
	$smt=$con->prepare("delete from admin where value=? and category=? ");
	$smt->bind_param('ss',$x,$y);
	$smt->execute();
	echo "<script>window.alert('Category Deleted');</script>";
	echo "<script>window.location.href='category.php';</script>";
}
else{
	echo "<script>window.alert('Category not found');</script>";
	echo "<script>window.location.href='category.php';</script>";
}	
?>