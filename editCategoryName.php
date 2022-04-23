<?php
$abc=0;
$oldCategory=isset($_GET['oldCategory']) ? $_GET['oldCategory'] : '';
$newCategory=isset($_GET['newCategory']) ? $_GET['newCategory'] : '';

	include('dbConnect.php');
	$smt=$con->prepare("update category set Category=? where Category=?");
	$smt->bind_param('ss',$newCategory,$oldCategory);
	$smt->execute();

	$smt1=$con->prepare("update current set Category=? where Category=?");
	$smt1->bind_param('ss',$newCategory,$oldCategory);
	$smt1->execute();

	$smt3=$con->prepare("update purchase set Category=? where Category=?");
	$smt3->bind_param('ss',$newCategory,$oldCategory);
	$smt3->execute();

	echo '<script>alert("Category Name Changed Successfully From"'.$oldCategory.'" to "'.$newCategory.')</script>';
?>