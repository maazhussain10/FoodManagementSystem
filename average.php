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
	<title>Average Report</title>
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
	$smt = $con->prepare("select distinct(item) from purchase where date>=? and date<=?");
	$smt->bind_param('ss', $x, $y);
	$smt->execute();
	$res = $smt->get_result();
	?>
	<h3 class="my-4" align="center">Average Report</h3>
	<div class="row my-3">
		<div class="col-sm-4 offset-sm-4">
			<center>MONTH: <input class="form-control" type="text" name="Month" value="<?php echo $_POST['date1']; ?>" disabled /> TO <input class="form-control" type="text" name="Month" value="<?php echo $_POST['date2']; ?>" disabled /></center><br />
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10 offset-sm-1">
			<div class="table-responsive">
				<table class="table table-light table-striped" align="center">
					<thead class="table-dark">
						<tr>
							<th>Item Name</th>
							<th>Total Quantity</th>
							<th>Total Amount</th>
							<th>Average Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($row = $res->fetch_assoc()) {
							$k = 0;
							echo "<tr>";
							$itemname = $row['item'];
							echo "<td>" . $itemname . "</td>";
							$smtinner = $con->prepare("select * from purchase where date>=? and date<=? and item=? ");
							$smtinner->bind_param('sss', $x, $y, $itemname);
							//echo $itemname;
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$m = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$m += $rowinner['quantity'];
								}
							}
							echo "<td>" . $m . "</td>";


							$smtinner = $con->prepare("select * from purchase where date>=? and date<=? and item=? ");
							$smtinner->bind_param('sss', $x, $y, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$m = 0;
							if (mysqli_num_rows($resinner) > 0) {
								while ($rowinner = $resinner->fetch_assoc()) {
									$m += $rowinner['amount'];
								}
							}
							echo "<td>" . $m . "</td>";

							$smtinner = $con->prepare("select * from purchase where date>=? and date<=? and item=? ");
							$smtinner->bind_param('sss', $x, $y, $itemname);
							$smtinner->execute();
							$resinner = $smtinner->get_result();
							$m = 0;
							$n = 0;
							$z = 0;
							//$m;
							if (mysqli_num_rows($resinner) > 0) {
								$c = 0;
								while ($rowinner = $resinner->fetch_assoc()) {
									$m = $rowinner['amountkg'];
									$n = $rowinner['quantity'];
									$z += ($m * $n);
									$c += $n;
								}
							}
							$d = 0;
							$d = $z / $c;
							echo "<td>Rs." . $d . "</td>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<br>
	<center>
		<button class="btn btn-primary" onclick="myFunction()">Print this page</button>

		<script>
			function myFunction() {
				window.print();
			}
		</script>

	</center>
	</div>
</body>

</html>