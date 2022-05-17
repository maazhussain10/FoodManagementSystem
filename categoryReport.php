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
		/* body {
			background-color: #CBFFC2;
		}

		th,
		td {
			border: 2px solid black;
			border-collapse: collapse;
			width: 1%;
			padding: 5px;
		} */
	</style>
</head>

<body>
	<?php
	$x = $_POST['date1'];
	$y = $_POST['date2'];

	include('dbConnect.php');
	$smt = $con->prepare("select distinct(category) from purchase where date>=? and date<=?");
	$smt->bind_param('ss', $x, $y);
	$smt->execute();
	$res = $smt->get_result();
	?>
	<h3 class="my-4" align="center">Categorywise Report</h3>
	<div class="row my-3">
		<div class="col-sm-4 offset-sm-4">
			<center>MONTH: <input class="form-control" type="text" name="Month" value="<?php echo $_POST['date1']; ?>" disabled />TO<input class="form-control" type="text" name="Month" value="<?php echo $_POST['date2']; ?>" disabled /></center><br />
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10 offset-sm-1">
			<div class="table-responsive">
				<table class="table table-light table-striped" align="center">
					<thead class="table-dark">
						<tr>
							<th scope="row">CATEGORY</th>
							<th scope="col">PURCHASED AMOUNT</th>
							<th scope="col">DISPATCHED AMOUNT</th>
						</tr>
					</thead>

					<tbody>
						<?php

						// DECLARE ALL VARIABLES
						$purchaseAmtTotal = 0;
						$dispatchedAmtTotal = 0;

						while ($row = $res->fetch_assoc()) {
							$dispatchedQuantities = 0;
							echo "<tr>";
							$categoryName = $row['category'];
							echo "<th>" . $categoryName . "</th>";

							//FOR PURCHASE
							$smtinner = $con->prepare("select * from purchase where date>=? and date<=? and category=?");
							$smtinner->bind_param('sss', $x, $y, $categoryName);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$val = 0;
							$purchasedQuantity = 0;
							$purchasedAmount = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$val += $rowinner['quantity'];
									$purchasedQuantity += $rowinner['quantity'];
									$purchasedAmount += $rowinner['amount'];
								}
							}


							echo "<td>" . round($purchasedAmount, 2) . "</td>";

							$purchaseAmtTotal += round($purchasedAmount, 2);

							$rate = ($purchasedAmount / $purchasedQuantity);


							// FOR DISPATCHED

							$smtinner1 = $con->prepare("select distinct(item) from purchase where date>=? and date<=? and category=? ");
							$smtinner1->bind_param('sss', $x, $y, $categoryName);
							$smtinner1->execute();
							$resinner1 = $smtinner1->get_result();
							$dispatchedQuantity = 0;

							if (mysqli_num_rows($resinner1) > 0) {
								while ($rowinner1 = $resinner1->fetch_assoc()) {
									$itemname = $rowinner1['item'];
									$smtinner = $con->prepare("select * from dispatch where date>=? and date<=? and item=? ");
									$smtinner->bind_param('sss', $x, $y, $itemname);
									$smtinner->execute();
									$resinner = $smtinner->get_result();

									if (mysqli_num_rows($resinner) > 0) {
										while ($rowinner = $resinner->fetch_assoc()) {
											$dispatchedQuantity += $rowinner['quantity'];
										}
									}
								}
							}
							echo "<td>" . round(($dispatchedQuantity * $rate), 2) . "</td>";

							$dispatchedAmtTotal += round(($dispatchedQuantity * $rate), 2);

							//	print_r($resinner);
						}

						echo "<tr>";
						echo "<th>Total</th>";
						echo "<th>" . $purchaseAmtTotal . "</th>";
						echo "<th>" . $dispatchedAmtTotal . "</th>";
						echo "<tr>";
						?>
					</tbody>
				</table>
			</div>

		</div>
	</div>

	</center>
	<br>
	<br>
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