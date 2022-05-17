<?php
session_start();
if (!isset($_SESSION['uname'])) {
	echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Stock Available</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<script src="jquery.min.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>

	</style>
</head>

<body>
	<?php
	include 'nav.php';
	?>
	<?php
	include('dbConnect.php');
	$smt = $con->prepare("select distinct(category) from category order by category;");
	$smt->execute();
	$res = $smt->get_result();
	?>
	<div class="container">
		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-center">
						<ul class="nav nav-tabs row" id="myTab" role="tablist">
							<li class="nav-item col-6" role="presentation">
								<a class="nav-link active" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab" aria-controls="add" aria-selected="true">ADD</a>
							</li>
							<li class="nav-item col-6" role="presentation">
								<a class="nav-link" id="remove-tab" data-bs-toggle="tab" data-bs-target="#remove" type="button" role="tab" aria-controls="remove" aria-selected="false">REMOVE</a>
							</li>

						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="add-tab">

								<h5 class="mt-3">Add Vendor </h5>


								<form action="addvendorbck.php" method="POST">
									<label class="form-label" for="name" id="tab">Enter Vendor Name:</label>
									<input type="text" id="name" class="form-control" name="vendor" placeholder="Add Vendor"><br>
									<label class="form-label" for="name" id="tab">Enter Category:</label>
									<?php
									echo "<select name=categoryName class='1 form-select' >";
									echo "<option value=''>Select Category</option>";
									$array_values = array();
									while ($row = $res->fetch_assoc()) {
										$value = $row['category'];
										array_push($array_values, $value);
										echo "<option value='" . $value . "'>" . $value . "</option>";
									}
									echo "</select>";
									?>
									<center><button type="submit" class="btn btn-info my-2">Submit</button></center>

								</form>

							</div>
							<div style="min-height: 250px;" class="tab-pane fade" id="remove" role="remove" aria-labelledby="remove-tab">


								<h5 class="my-3">Remove Vendor </h5>


								<form action="removevendorbck.php" role="form" method="POST">
									<label class="form-label" for="name" id="tab">Enter Vendor Name:</label>
									<?php
									include('dbConnect.php');
									$smt = $con->prepare("select * from vendor order by vendorName");
									$smt->execute();
									$res = $smt->get_result();
									?>
									<select name="vendor" class="form-select">
										<?php
										while ($row = $res->fetch_assoc()) {
											echo "<option value='" . $row['vendorName'] . "'>" . $row['vendorName'] . "</option>";
										}

										?>
									</select>
									<br />
									<center><button type="submit" class="btn btn-info">Submit</button></center>
								</form>



							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
		<center class="my-5">
			<h2>List of Vendors </h2>
		</center>
		<div class="row mb-3 text-center">
			<div class="col-sm-6 offset-sm-3">
				<ul class="list-group">
					<?php
					$smt = $con->prepare("select * from vendor order by vendorName");
					$smt->execute();
					$res = $smt->get_result();
					while ($row = $res->fetch_assoc()) {
						echo "<li class='list-group-item' >" . $row["vendorName"] . "</li>";
					}
					?>
				</ul>
			</div>
		</div>


		<center>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
				ADD/REMOVE VENDOR
			</button>
		</center>


	</div>

</body>

</html>