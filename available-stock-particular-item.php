<?php
$itemname = $_POST["item"];
include('dbConnect.php');
$sql = "select * from current where item = ? ";
$statement = $con->prepare($sql);
$statement->bind_param('s',$itemname);
$statement->execute();
$result = $statement->get_result();
if($row = $result->fetch_assoc()){
	echo $row["quantity"];
}
else{
	echo "This item is not available";
}
?>