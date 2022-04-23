<?php
session_start();
if(!isset($_SESSION['uname'])){
	header('Location: index.php');
}
if($_POST['date']==""){
	echo '<script>alert("Enter the Date");</script>';
	echo '<script>window.location.href="attendence.php";</script>';
}
$tot=$_POST['rmk_staff']+$_POST['rmk_student']+$_POST['rmk_worker']+$_POST['rmd_staff']+$_POST['rmd_student']+$_POST['rmd_worker']+$_POST['cet_staff']+$_POST['cet_student']+$_POST['cet_worker']+$_POST['school_staff']+$_POST['school_student']+$_POST['school_worker']+$_POST['r_staff']+$_POST['r_student']+$_POST['r_worker']+$_POST['cbse_staff']+$_POST['cbse_student']+$_POST['cbse_worker']+$_POST['poly_staff']+$_POST['poly_student']+$_POST['poly_worker'];
	include('dbConnect.php');	
	$smt=$con->prepare("insert into attendence(date,rmk_staff,rmk_students,rmk_workers,rmd_staff,rmd_students,rmd_workers,cet_staff,cet_students,cet_workers,school_staff,school_students,school_workers,r_staff,r_students,r_workers,cbse_staff,cbse_students,cbse_workers,poly_staff,poly_students,poly_workers,total_count) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$smt->bind_param('siiiiiiiiiiiiiiiiiiiiii',$_POST['date'],$_POST['rmk_staff'],$_POST['rmk_student'],$_POST['rmk_worker'],$_POST['rmd_staff'],$_POST['rmd_student'],$_POST['rmd_worker'],$_POST['cet_staff'],$_POST['cet_student'],$_POST['cet_worker'],$_POST['school_staff'],$_POST['school_student'],$_POST['school_worker'],$_POST['r_staff'],$_POST['r_student'],$_POST['r_worker'],$_POST['cbse_staff'],$_POST['cbse_student'],$_POST['cbse_worker'],$_POST['poly_staff'],$_POST['poly_student'],$_POST['poly_worker'],$tot);
	$smt->execute();
	echo '<script>alert("Sucess");</script>';
	echo '<script>window.location.href="attendence.php";</script>';
?>