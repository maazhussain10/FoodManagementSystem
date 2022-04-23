<?php
session_start();
if(!isset($_SESSION['uname'])){
	header('Location: index.php');
}
$item1=$_POST['item'];
$quantity1=$_POST['quantity'];
$place1=$_POST['place'];

include('dbConnect.php');
$smt=$con->prepare("select * from current where item=?");
$smt->bind_param('s',$item1);
$smt->execute();
$res=$smt->get_result();

if($row=$res->fetch_assoc())
{
if(($row['quantity']-$quantity1)<0)
{
	echo "<script>alert('Stock Not Available');</script>";
	echo "<script>window.location.href='dispatch.php';</script>";
}
else{
	$x=$row['quantity']-$quantity1;
	$smt=$con->prepare("update current set quantity=? where item=?");
	$smt->bind_param('ss',$x,$item1);
	$smt->execute();
	
	
	$smt=$con->prepare("insert into dicsspatch (item,quantity,place) values(?,?,?)");
	$smt->bind_param('sss',$item1,$quantity1,$place1);
	$smt->execute();
}
}
else{
	echo "<script>alert('Item Not Available');</script>";
	echo "<script>window.location.href='dispatch.php';</script>";
}
echo "<script>alert('Dispatch success');</script>";
echo "<script>window.location.href='dispatch.php';</script>";
?>