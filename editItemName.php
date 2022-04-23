<?php
$abc=0;
$oldItem=isset($_GET['oldItem']) ? $_GET['oldItem'] : '';
$newItem=isset($_GET['newItem']) ? $_GET['newItem'] : '';

	include('dbConnect.php');
	$smt=$con->prepare("update category set item=? where item=?");
	$smt->bind_param('ss',$newItem,$oldItem);
	$smt->execute();
	
	$smt1=$con->prepare("update current set item=? where item=?");
	$smt1->bind_param('ss',$newItem,$oldItem);
	$smt1->execute();
	
	$smt2=$con->prepare("update dispatch set item=? where item=?");
	$smt2->bind_param('ss',$newItem,$oldItem);
	$smt2->execute();

	$smt3=$con->prepare("update purchase set item=? where item=?");
	$smt3->bind_param('ss',$newItem,$oldItem);
	$smt3->execute();

	echo '<script>alert("Item Name Changed Successfully From"'.$oldItem.'" to "'.$newItem.')</script>';
?>