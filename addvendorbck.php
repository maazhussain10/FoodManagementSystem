<?php
session_start();
if(!isset($_SESSION['uname']))
{
	echo "<script>window.location.href='index.php';</script>";
}
if(!isset($_POST['vendor']))
{
	echo "<script>window.location.href='vendors.php';</script>";
}
include('dbConnect.php');
$vendorName=$_POST['vendor'];
$category = $_POST['categoryName'];
$smt=$con->prepare("select * from vendor where vendorName=? and category=? ");
$smt->bind_param('ss',$vendorName,$category);
$smt->execute();
$res=$smt->get_result();
if($row=$res->fetch_assoc())
{
	echo "<script>window.alert('Value Already Exists');</script>";
	echo "<script>window.location.href='vendors.php';</script>";
}
else{
	$smt=$con->prepare("insert into vendor(vendorName,category) values(?,?)");
	$smt->bind_param('ss',$vendorName,$category);
	$smt->execute();
	echo "<script>window.alert('Value Added Successfully');</script>";
	echo "<script>window.location.href='vendors.php';</script>";
}
?>