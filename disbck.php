<?php
session_start();
if(!isset($_SESSION['uname'])){
	header('Location: index.php');
}
function dodispatch($item,$quantity,$place,$date){
		include('dbConnect.php');
		$smt=$con->prepare("select * from current where item=?");
		$smt->bind_param('s',$item);
		$smt->execute();
		$res=$smt->get_result();
		if($row=$res->fetch_assoc())
		{
		if((floatval($row['quantity'])-floatval($quantity))<0)
		{
			echo "<script>alert('Stock Not Available');</script>";
		}
		else{
			$x=floatval($row['quantity'])-floatval($quantity);
			$smt=$con->prepare("update current set quantity=? where item=?");
			$smt->bind_param('ss',$x,$item);
			$smt->execute();
      if(floatval($quantity)!=0){
        $smt=$con->prepare("insert into dispatch (item,quantity,place,date) values(?,?,?,?)");
        $smt->bind_param('ssss',$item,$quantity,$place,$date);
        $smt->execute();
      }
		}
		}
		else{
			echo "<script>alert('Item Not Available');</script>";
		}
		$con->close();
}

$date=$_POST['date'];

$counter = 1;
$item = "name".$counter;
while(isset($_POST[$item]) && $_POST[$item] !="" ) {
	if($_POST['date']==""){
		echo "<script>window.alert('Please Select the Date');window.location.href='dispatch.php';</script>";
	}
	else{
		if(isset($_POST["rmk".$counter])){
			dodispatch( $_POST[$item] , $_POST["rmk".$counter] , "RMK" ,$date);
		}

		if(isset($_POST["rmd".$counter])){
			dodispatch( $_POST[$item] , $_POST["rmd".$counter] , "RMD" ,$date);
		}

		if(isset($_POST["rmkcet".$counter])){
			dodispatch( $_POST[$item] , $_POST["rmkcet".$counter] , "RMKCET" ,$date);
		}

		if(isset($_POST["school".$counter])){
			dodispatch( $_POST[$item] , $_POST["school".$counter] , "SCHOOL" ,$date);
		}
	}
	$counter++;
	$item = "name".$counter;
}
echo "<script>alert('Dispatch success');</script>";
echo "<script>window.location.href='dispatch.php';</script>";
