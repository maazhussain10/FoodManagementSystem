<?php
session_start();
if (!isset($_SESSION['uname'])) {
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
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<script src="jquery.min.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		/* body{
background-color:#CBFFC2;
}
  th,td
  {
    border:2px solid black;
    border-collapse: collapse;
    width:1%;
    padding: 5px;
  } */
	</style>
</head>

<body>
	<?php
	$x = $_POST['date1'];
	$y = $_POST['date2'];

	include('dbConnect.php');
	$smt = $con->prepare("select distinct(item),category from dispatch where date>=? and date<=? order by category");
	$smt->bind_param('ss', $x, $y);
	$smt->execute();
	$res = $smt->get_result();
	?>
	<h3 class="my-4" align="center">Monthwise Report</h3>
	<div class="row my-3">
		<div class="col-sm-4 offset-sm-4">
			<center>MONTH: <input class="form-control" type="text" name="Month" value="<?php echo $_POST['date1']; ?>" disabled />TO<input class="form-control" type="text" name="Month" value="<?php echo $_POST['date2']; ?>" disabled /></center><br />
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-light table-striped table-bordered" align="center">
					<thead class="table-dark">
						<tr>
							<!--  <th>SN0</th> -->
							<th scope="row" rowspan="2">ITEM</th>
							<th scope="col" colspan="2">OPENING STOCK </th>
							<th scope="col" colspan="3">PURCHASE</th>
							<th scope="col" colspan="2">TOTAL</th>
							<th scope="col" colspan="2">RMK</th>
							<th scope="col" colspan="2">RMD</th>
							<th scope="col" colspan="2">RMKCET</th>
							<th scope="col" colspan="2">SCHOOL</th>
							<th scope="col" colspan="3">ISSUES TOTAL</th>
							<th scope="col" colspan="2">CLOSING STOCK</th>
							<!--  <th>CLOSING STOCK</th> -->
						</tr>
						<tr>
							<!-- <td></td> -->
							<th>Qty</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Rate</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Rate</th>
							<th>Amount</th>
							<th>Qty</th>
							<th>Amount</th>
						</tr>
					</thead>

					<tbody>
						<?php

						// DECLARE ALL VARIABLES

						$openingStockQtyTotal = 0;
						$openingStockAmtTotal = 0;
						$purchaseQtyTotal = 0;
						$purchaseRateTotal = 0;
						$purchaseAmtTotal = 0;
						$totalQtyTotal = 0;
						$totalAmtTotal = 0;
						$rmkQtyTotal = 0;
						$rmkAmtTotal = 0;
						$rmdQtyTotal = 0;
						$rmdAmtTotal = 0;
						$rmkcetQtyTotal = 0;
						$rmkcetAmtTotal = 0;
						$schoolQtyTotal = 0;
						$schoolAmtTotal = 0;
						$issuesQtyTotal = 0;
						$issuesRateTotal = 0;
						$issuesAmtTotal = 0;
						$closingStockQtyTotal = 0;
						$closingStockAmtTotal = 0;


						$dispCategory = "";
						while ($row = $res->fetch_assoc()) {
							$category = $row['category'];
							if ($dispCategory != $category) {
								$dispCategory = $category;
								echo "<tr><th style=text-align:center; font-size:20px scope=col colspan=21>" . $category . "</th></tr>";
							}
							$dispatchedQuantities = 0;
							echo "<tr>";
							$itemname = $row['item'];
							echo "<th>" . $itemname . "</th>";

							// Get the Rate of each Item.
							$smtinner = $con->prepare("select * from purchase where date>=? and date<=? and item=? ");
							$smtinner->bind_param('sss', $x, $y, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$amountKg = 0;
							$quantity = 0;
							$totalAmount = 0;
							$totalQuantity = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$amountKg = $rowinner['amountkg'];
									$quantity = $rowinner['quantity'];
									$totalAmount += ($amountKg * $quantity);
									$totalQuantity += $quantity;
								}
							}
							$rate = 0;
							if ($totalQuantity != 0)
								$rate = $totalAmount / $totalQuantity;

							// FOR OPENING STOCK


							$smtinner = $con->prepare("select * from purchase where date<? and item=?; ");
							$smtinner1 = $con->prepare("select * from dispatch where date<? and item=?;");

							//Purchase
							$smtinner->bind_param('ss', $x, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();

							//Dispatch
							$smtinner1->bind_param('ss', $x, $itemname);
							$smtinner1->execute();
							$resinner1 = $smtinner1->get_result();

							// Opening Stock Purchase and Amount
							$openingStockPurchased = 0;
							$openingStockAmount = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$openingStockPurchased += $rowinner['quantity'];
									$openingStockAmount += $rowinner['amount'];
								}
							}

							$openingStockRate = 0;
							if ($openingStockPurchased != 0)
								$openingStockRate = $openingStockAmount / $openingStockPurchased;

							// Opening Stock Dispatched
							$openingStockDispatched = 0;
							if (mysqli_num_rows($resinner1) > 0) {
								while ($rowinner = $resinner1->fetch_assoc()) {
									$openingStockDispatched += $rowinner['quantity'];
								}
							}
							// Opening Stock Pending.

							$openingStock = ($openingStockPurchased - $openingStockDispatched);
							if ($openingStock < 0)
								$openingStock = 0;

							echo "<td>" . $openingStock . "</td>";
							echo "<td>" . (round($openingStock * $openingStockRate, 2)) . "</td>";

							$openingStockQtyTotal += $openingStock;
							$openingStockAmtTotal += round($openingStock * $openingStockRate, 2);

							//FOR PURCHASE


							$smtinner = $con->prepare("select * from purchase where date>=? and date<=? and item=? ");
							$smtinner->bind_param('sss', $x, $y, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$val = 0;
							$purchasedQuantity = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$val += $rowinner['quantity'];
									$purchasedQuantity += $rowinner['quantity'];
								}
							}

							echo "<td>" . $purchasedQuantity . "</td>";
							echo "<td>" . round($rate, 2) . "</td>";
							echo "<td>" . round($purchasedQuantity * $rate, 2) . "</td>";


							$purchaseQtyTotal += $purchasedQuantity;
							$purchaseRateTotal += round($rate, 2);
							$purchaseAmtTotal += round($purchasedQuantity * $rate, 2);


							// FOR TOTAL

							echo "<td>" . ($openingStock + $purchasedQuantity) . "</td>";
							echo "<td>" . round(($openingStock + $purchasedQuantity) * $rate, 2) . "</td>";

							$totalQtyTotal += $openingStock + $purchasedQuantity;
							$totalAmtTotal += round(($openingStock + $purchasedQuantity) * $rate, 2);



							// FOR RMK


							$smtinner = $con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
							$cname = 'RMK';
							$smtinner->bind_param('ssss', $x, $y, $cname, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$rmkVal = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$rmkVal += $rowinner['quantity'];
								}
							}
							echo "<td>" . $rmkVal . "</td>";
							echo "<td>" . round($rmkVal * $rate, 2) . "</td>";
							$dispatchedQuantities += $rmkVal;

							$rmkQtyTotal += $rmkVal;
							$rmkAmtTotal +=  round($rmkVal * $rate, 2);


							// FOR RMD


							$smtinner = $con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
							$cname = 'RMD';
							$smtinner->bind_param('ssss', $x, $y, $cname, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$rmdVal = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$rmdVal += $rowinner['quantity'];
								}
							}
							echo "<td>" . $rmdVal . "</td>";
							echo "<td>" . round($rmdVal * $rate, 2) . "</td>";
							$dispatchedQuantities += $rmdVal;

							$rmdQtyTotal += $rmdVal;
							$rmdAmtTotal +=  round($rmdVal * $rate, 2);


							// FOR RMKCET


							$smtinner = $con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
							$cname = 'RMKCET';
							$smtinner->bind_param('ssss', $x, $y, $cname, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$rmkcetVal = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$rmkcetVal += $rowinner['quantity'];
								}
							}

							$dispatchedQuantities += $rmkcetVal;

							echo "<td>" . $rmkcetVal . "</td>";
							echo "<td>" . round($rmkcetVal * $rate, 2) . "</td>";

							$rmkcetQtyTotal += $rmkcetVal;
							$rmkcetAmtTotal +=  round($rmkcetVal * $rate, 2);


							// FOR SCHOOL


							$smtinner = $con->prepare("select * from dispatch where date>=? and date<=? and place=? and item=? ");
							$cname = 'SCHOOL';
							$smtinner->bind_param('ssss', $x, $y, $cname, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$school = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$school += $rowinner['quantity'];
								}
							}
							echo "<td>" . $school . "</td>";
							echo "<td>" . round($school * $rate, 2) . "</td>";

							$dispatchedQuantities += $school;

							$schoolQtyTotal += $school;
							$schoolAmtTotal +=  round($school * $rate, 2);

							// ISSUES TOTAL

							echo "<td>" . $dispatchedQuantities . "</td>";
							echo "<td>" . round($rate, 2) . "</td>";
							echo "<td>" . round($dispatchedQuantities * $rate, 2) . "</td>";

							$issuesQtyTotal += $dispatchedQuantities;
							$issuesRateTotal += round($rate, 2);
							$issuesAmtTotal +=  round($dispatchedQuantities * $rate, 2);

							// CLOSING STOCK

							echo "<td>" . (($openingStock + $purchasedQuantity) - $dispatchedQuantities) . "</td>";
							echo "<td>" . round((($openingStock + $purchasedQuantity) - $dispatchedQuantities) * $rate, 2) . "</td>";

							$closingStockQtyTotal += (($openingStock + $purchasedQuantity) - $dispatchedQuantities);
							$closingStockAmtTotal += round((($openingStock + $purchasedQuantity) - $dispatchedQuantities) * $rate, 2);

							echo "</tr>";
							//	print_r($resinner);
						}

						echo "<tr>";
						echo "<th>Total</th>";
						echo "<th>" . $openingStockQtyTotal . "</th>";
						echo "<th>" . $openingStockAmtTotal . "</th>";
						echo "<th>" . $purchaseQtyTotal . "</th>";
						echo "<th>" . $purchaseRateTotal . "</th>";
						echo "<th>" . $purchaseAmtTotal . "</th>";
						echo "<th>" . $totalQtyTotal . "</th>";
						echo "<th>" . $totalAmtTotal . "</th>";
						echo "<th>" . $rmkQtyTotal . "</th>";
						echo "<th>" . $rmkAmtTotal . "</th>";
						echo "<th>" . $rmdQtyTotal . "</th>";
						echo "<th>" . $rmdAmtTotal . "</th>";
						echo "<th>" . $rmkcetQtyTotal . "</th>";
						echo "<th>" . $rmkcetAmtTotal . "</th>";
						echo "<th>" . $schoolQtyTotal . "</th>";
						echo "<th>" . $schoolAmtTotal . "</th>";
						echo "<th>" . $issuesQtyTotal . "</th>";
						echo "<th>" . $issuesRateTotal . "</th>";
						echo "<th>" . $issuesAmtTotal . "</th>";
						echo "<th>" . $closingStockQtyTotal . "</th>";
						echo "<th>" . $closingStockAmtTotal . "</th>";
						echo "<tr>";
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	
	<center>
		<button class="btn btn-primary" onclick="myFunction()">Print this page</button>
		<script>
			function myFunction() {
				window.print();
			}
		</script>
	</center>
</body>

</html>