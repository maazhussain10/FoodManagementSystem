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
$smt=$con->prepare("select distinct(item) from dispatch where date>=? and date<=? order by item");
$smt->bind_param('ss',$x,$y);
$smt->execute();
$res=$smt->get_result();
?>
<h1 align="center">Item Wise Report</h1>
<hr/>
<center>MONTH:    <input type="text" name="Month" value="<?php echo $_POST['date1'];?>" disabled /> <input type="text" name="Month" value="<?php echo $_POST['date2'];?>" disabled /></center><br/> 
<table align="center">
  <tr>
<!--  <th>SN0</th> -->
  <th>ITEM</th>
  <!--<th>OPENING STOCK</th>  -->
  <th>PURCHASE</th> 
  <th>RMK</th>
  <th>RMD</th>
  <th>RMKCET</th>
  <th>SCHOOL</th>
  <th>ISSUES TOTAL</th>
<!--  <th>CLOSING STOCK</th> -->
</tr>
<tbody>
<?php
while($row=$res->fetch_assoc())
{
	$k=0;
	echo "<tr>";
	$itemname = $row['item'];
	echo "<td>".$itemname ."</td>";
	//for opening stock
	/*$smtinner=$con->prepare("select * from current where date<=? and item=? orderby desc");
	$smtinner->bind_param('sss',$x,$y,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$x=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$x+=$rowinner['quantity'];
		}
	}*/
	//print_r();
	//for purchase
	$smtinner=$con->prepare("select * from purchase where date>=? and date<=? and item=? ");
	$smtinner->bind_param('sss',$x,$y,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$val=0;
	$purchasedQuantity=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$val+=$rowinner['quantity'];
			$purchasedQuantity+=$rowinner['quantity'];
		}
	}
	echo "<td>".$purchasedQuantity ."</td>";


	//for RMK
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
	$cname='RMK';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$val=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$val+=$rowinner['quantity'];
		}
	}
	echo "<td>" .$val ."</td>";
	$k+=$val;

	//for RMD
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
	$cname='RMD';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$val=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$val+=$rowinner['quantity'];
		}
	}
	echo "<td>" .$val ."</td>";
	$k+=$val;
	//for RMKCET
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
	$cname='RMKCET';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$val=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$val+=$rowinner['quantity'];
		}
	}
	$k+=$val;
	echo "<td>" .$val ."</td>";
	//for school
	$smtinner=$con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=?");
	$cname='SCHOOL';
	$smtinner->bind_param('ssss',$x,$y,$cname,$itemname);
	$smtinner->execute();
	$resinner=$smtinner->get_result();
	$val=0;
	if(mysqli_num_rows($resinner)>0){
		while($rowinner=$resinner->fetch_assoc()){
			$val+=$rowinner['quantity'];
		}
	}
	echo "<td>" .$val ."</td>";
	$k+=$val;
	echo "<td>" .$k ."</td>";
	echo "</tr>";
}
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
