<?php
session_start();
if(!isset($_SESSION['uname'])){
  echo "<script>window.location.href='index.php';</script>";
}

function ins($item,$category,$quantity,$amountkg,$total,$date){
  $count = 0;
	$amount=0;
	include('dbConnect.php');
	$smt=$con->prepare("insert into purchase(item,category,quantity,amountkg,amount,date) values(?,?,?,?,?,?)");
	$smt->bind_param('ssssss',$item,$category,$quantity,$amountkg,$total,$date);
	$smt->execute();
	$smt=$con->prepare("select * from current where item=?");
	$smt->bind_param('s',$item);
	$smt->execute();
	$res=$smt->get_result();
	if($row=$res->fetch_assoc())
	{
		$x=$row['quantity'];
		$x=$x+$quantity;
		$smt=$con->prepare("update current set quantity=? where item=?");
		$smt->bind_param('ss',$x,$item);
		$smt->execute();
	}
	else{
		$smt=$con->prepare("insert into current(item,category,quantity) values(?,?,?)");
	   $smt->bind_param('sss',$item,$category,$quantity);
	   $smt->execute();
	}
	$con->close();
}

$counter = 1;
$item = "name".$counter;
while(isset($_POST[$item]) && $_POST[$item] !="" ) {
  echo $_POST["date"];
  if($_POST["date"]==""){
      echo "<script>window.alert('Please Select any Date');window.location.href='purchase.php';</script>";
    }
    echo $_POST[$item];
    echo $_POST["category1"];
  if($_POST[$item]!="" && $_POST["category".$counter]!="" && $_POST["qty".$counter]!="" && $_POST["amt".$counter]!="" && $_POST["total".$counter]!="" && $_POST['date']!="")
    {
      $date = $_POST["date"];
      $item=$_POST["name".$counter];
      $category=$_POST["category".$counter];
      $quantity=$_POST["qty".$counter];
      $amountkg=$_POST["amt".$counter];
      $total=$_POST["total".$counter];

      ins($item,$category,$quantity,$amountkg,$total,$date);
    }
    $counter++;
    $item = "name".$counter;
}

echo "<script>window.alert('Data inserted Successfully');</script>";
echo "<script>window.location.href='purchase.php';</script>";
?>
