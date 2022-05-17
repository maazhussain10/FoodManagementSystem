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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
	<style>


	</style>
</head>

<body>
	<?php
	include 'nav.php';
	?>
	<div class="container">

		<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

								<h5 class="mt-3">Add Category </h5>




								<form action="addcategorybck.php" method="POST">
									<label class="form-label" for="name" id="tab">Enter Category Name:</label>
									<input type="text" id="name" class="form-control mb-2" name="category" placeholder="Add category">
									<label class="form-label" for="name" id="tab">Enter Item name:</label>
									<input type="text" id="name" class="form-control mb-2" name="item" placeholder="Add item">
									<button type="submit" class="btn btn-primary mb-2">Submit</button>
								</form>

							</div>
							<div style="min-height: 234px;" class="tab-pane fade" id="remove" role="remove" aria-labelledby="remove-tab">

								<h5 class="mt-3">Remove category </h5>


								<form action="removecategorybck.php" role="form" method="POST">
									<label class="form-label" for="name" id="tab">Enter category Name:</label>
									<?php
									include('dbConnect.php');
									$smt = $con->prepare("select distinct(category) from category");
									$smt->execute();
									$res = $smt->get_result();
									?>
									<select name="category" class="form-control">
										<?php
										while ($row = $res->fetch_assoc()) {
											echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
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

		<center class="my-3">
			<h2>List of category </h2>

		</center>

		<div class="row text-center">
			<div class="col-sm-6 offset-sm-3">
				<ul class="list-group">

					<?php
					$smt = $con->prepare("select distinct(category) from category");
					$smt->execute();
					$res = $smt->get_result();
					while ($row = $res->fetch_assoc()) {
						echo "<li class='list-group-item' contenteditable='false' onchange='editCategory()' >" . $row["category"] . "</li>";
					?>
						<script>
							function fix_onChange_editable_elements() {
								var tags = document.querySelectorAll('[contenteditable=false][onchange]');

								var editable_elements = document.querySelectorAll("[contenteditable=false]");
								for (var i = 0; i < editable_elements.length; i++)
									editable_elements[i].setAttribute("contenteditable", true);

								for (var i = tags.length - 1; i >= 0; i--)
									if (typeof(tags[i].onblur) != 'function') {
										tags[i].onfocus = function() {
											this.data_orig = this.innerHTML;
										};
										tags[i].onblur = function() {
											if (this.innerHTML != this.data_orig) {
												console.log(this.data_orig, this.innerHTML)
												editCategoryName(this.data_orig, this.innerHTML);
												delete this.data_orig;
											}
										};
									}
							}

							function editCategoryName(oldData, newData) {
								console.log(oldData, newData);
								var xhttp = new XMLHttpRequest();
								xhttp.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
										console.log(this.responseText);
									}
								};
								xhttp.open("GET", "editCategoryName.php?newCategory=" + newData + "&oldCategory=" + oldData, true);
								xhttp.send();
							}
						</script><?php
								}
									?>
				</ul>
			</div>
		</div>
		<center class="my-3">
		<form class="mb-2" action="updateCategory.php" method="POST">
			<button class="btn btn-primary" onclick="fix_onChange_editable_elements()">EDIT</button>
			<button type="submit" class="btn btn-success">Update Category</button>
		</form>


			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
				ADD / REMOVE CATEGORY
			</button>
		</center>
		

	</div>

</body>

</html>