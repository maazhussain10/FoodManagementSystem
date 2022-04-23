<?php
session_start();
if(!isset($_SESSION['uname']))
{
echo "<script>window.location.href='index.php';</script>";
}
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>console report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
    body{
background-color:#CBFFC2;
}
  th,td
  {
    border:2px solid black;
    border-collapse: collapse;
    width:1%;
    padding: 5px;
  }
</style>
</head>
<body>
<?php
$x=$_POST['date1'];
$y=$_POST['date2'];

include('dbConnect.php');
$smt=$con->prepare("select distinct(category) from purchase where date>=? and date<=?");
$smt->bind_param('ss',$x,$y);
$smt->execute();
$res=$smt->get_result();
?>
<h1 align="center">Categorywise Report</h1>
<hr/>
<center>MONTH:    <input type="text" name="Month" value="<?php echo $_POST['date1'];?>" disabled /> <input type="text" name="Month" value="<?php echo $_POST['date2'];?>" disabled /></center><br/> 
<table align="center">
  <tr>
  <th scope="row">CATEGORY</th>
  <th scope="col" >PURCHASED AMOUNT</th>
  <th scope="col" >DISPATCHED AMOUNT</th>
</tr>
<tbody>
<?php

// DECLARE ALL VARIABLES
$purchaseAmtTotal=0;
$dispatchedAmtTotal=0;

while($row=$res->fetch_assoc())
{
	$dispatchedQuantities=0;
	echo "<tr>";
	$categoryName = $row['category'];
	echo "<th>".$categoryName ."</th>";

//FOR PURCHASE
    $smtinner=$con->prepare("select * from purchase where date>=? and date<=? and category=?");
	$smtinner->bind_param('sss',$x,$y,$categoryName);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$val=0;
	$purchasedQuantity=0;
	$purchasedAmount=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$val+=$rowinner['quantity'];
			$purchasedQuantity+=$rowinner['quantity'];
			$purchasedAmount+=$rowinner['amount'];
		}
	}


	echo "<td>".round($purchasedAmount,2) ."</td>";

	$purchaseAmtTotal += round($purchasedAmount,2);

	$rate=($purchasedAmount/$purchasedQuantity);


// FOR DISPATCHED

	$smtinner1=$con->prepare("select distinct(item) from purchase where date>=? and date<=? and category=? ");
	$smtinner1->bind_param('sss',$x,$y,$categoryName);
	$smtinner1->execute();
	$resinner1=$smtinner1->get_result();
	$dispatchedQuantity=0;

	if(mysqli_num_rows($resinner1)>0){
		while($rowinner1=$resinner1->fetch_assoc()){
			$itemname=$rowinner1['item'];
			$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and item=? ");
			$smtinner->bind_param('sss',$x,$y,$itemname);
			$smtinner->execute();
			$resinner=$smtinner->get_result();
			
			if(mysqli_num_rows($resinner)>0){
				while($rowinner=$resinner->fetch_assoc()){
					$dispatchedQuantity+=$rowinner['quantity'];
				}
			}
		}
	}
	echo "<td>" .round(($dispatchedQuantity*$rate),2) ."</td>";

	$dispatchedAmtTotal+=round(($dispatchedQuantity*$rate),2);

//	print_r($resinner);
}

	echo "<tr>";
		echo "<th>Total</th>";
		echo "<th>".$purchaseAmtTotal."</th>";
		echo "<th>".$dispatchedAmtTotal."</th>";
	echo "<tr>";
?>
</tbody>
</table>
</center>
<br>
<br>
<center>
<button onclick="myFunction()">Print this page</button>
<script>
function myFunction() {
  window.print();
}
</script>
</body>
</html>
