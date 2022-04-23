<?php
include('dbConnect.php');
$category=$_POST['category'];
$smt=$con->prepare("select * from vendor where category=?");
$smt->bind_param('s',$category);
$smt->execute();
$res=$smt->get_result();
while($row=$res->fetch_assoc())
{
	echo $row["vendorName"];
}
?>
