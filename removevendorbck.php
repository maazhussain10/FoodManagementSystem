<?php
session_start();
if(!isset($_SESSION['uname']))
{
	echo "<script>window.location.href='index.php';</script>";
}
if(!isset($_POST['vendor']))
{
	echo "<script>window.location.href='removevendor.php';</script>";
}
include('dbConnect.php');
$x=$_POST['vendor'];
$vendorName=$_POST['vendor'];
$smt=$con->prepare("select * from vendor where vendorName=? ");
$smt->bind_param('s',$vendorName);
$smt->execute();
$res=$smt->get_result();
if($row=$res->fetch_assoc())
{
	$smt=$con->prepare("delete from vendor where vendorName=?");
	$smt->bind_param('s',$vendorName);
	$smt->execute();
	echo "<script>window.alert('Vendor Deleted');</script>";
	echo "<script>window.location.href='vendors.php';</script>";
}
else{
	echo "<script>window.alert('Vendor not found');</script>";
	echo "<script>window.location.href='vendors.php';</script>";
}	
?>