<?php
session_start();
if(!isset($_SESSION['uname']))
{
	header('Location: index.php');
}
if(!isset($_POST['date2']) || !isset($_POST['date1']))
{
	header('Location: dateselect.php');
}
$x=$_POST['date1'];
$y=$_POST['date2'];

include('dbConnect.php');
$smt=$con->prepare("select distinct(item) from dispatch where date>=? and date<=?");
$smt->bind_param('ss',$x,$y);
$smt->execute();
$res=$smt->get_result();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Datewise Dispatch Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
body{
background-color:#CBFFC2;
}
</style>
</head>
<body>
<?php 
include 'nav.php';
?>
<div class="container">


  <center><h2>Datewise Dispatch Report</h2></center>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Item</th>
        <th>RMK</th>
        <th>RMD</th>
		<th>RMKCET</th>
      </tr>
    </thead>
    <tbody>
<?php
while($row=$res->fetch_assoc())
{	
	echo "<tr>";
	$itemname = $row['item'];
	echo "<td>" .$itemname ."</td>";
	//for RMK
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
	$cname='RMK';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$x=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$x+=$rowinner['quantity'];
		}
	}
	echo "<td>" .$x ."</td>";
	
	//for RMD
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
	$cname='RMD';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$x=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$x+=$rowinner['quantity'];
		}
	}
	echo "<td>" .$x ."</td>";
	
	//for RMKCET
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
	$cname='RMKCET';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$x=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$x+=$rowinner['quantity'];
		}
	}
	echo "<td>" .$x ."</td>";
	
	echo "</tr>";
//	print_r($resinner);
}
?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php
	/*echo "<tr>";
	echo "<td>" .$row['item'] ."</td>";
	echo "<td>" .$row['quantity'] ."</td>";
	echo "<td>" .$row['place'] ."</td>";
	$dt=explode(" ",$row['date']);
	$d=$dt[0];	
	echo "<td>" .$d ."</td>";
	echo "</tr>";*/?>