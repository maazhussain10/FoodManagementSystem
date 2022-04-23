<?php
session_start();
if(!isset($_POST["uname"]))
{echo "<script>window.location.href='index.php';</script>";}
$x=$_POST["uname"];
$y=$_POST["pass"];
include('dbConnect.php');
$smt=$con->prepare("select * from users where uname=? and pass=?");
$smt->bind_param('ss',$x,$y);
$smt->execute();
$rst=$smt->get_result();
if($rst->fetch_assoc())
{
	$_SESSION['uname']=$x;
	echo "<script>window.location.href='homepage.php';</script>";
}
else{
	echo '<script>alert("Invalid credentials");</script>';
	echo "<script>window.location.href='index.php';</script>";
}
?>