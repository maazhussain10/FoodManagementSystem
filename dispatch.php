
<?php
include('dbConnect.php');
$smt = $con->prepare("select distinct(item) from category order by item;");
$smt->execute();
$res = $smt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Dispatch</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<script src="jquery.min.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style type="text/css">



	</style>
</head>

<body>
<?php
include 'nav.php';
?>
	<center class="mt-5">
		<h3>Dispatch details</h3>
	</center>
	<form action="disbck.php" method="post" name="entryForm">
		<div class="row">
			<div class="col-sm-4 offset-sm-4">
				<center class="mb-3 text-center">
					<label for="date" class="form-label">Enter Date</label>
					<input class="form-control" type="date" id="date" name="date" placeholder="Select date" />
				</center>
			</div>
		</div>
		<br>
	<div class="row">
		<div class="col-sm-10 offset-sm-1">
			<div class="table-responsive">
			<table class="table table-light">
			<thead class="table-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Select Item</th>
					<th scope="col">Quantity</th>
					<th scope="col">RMK</th>
					<th scope="col">RMD</th>
					<th scope="col">RMKCET</th>
					<th scope="col">RMK School</th>
				</tr>
			</thead>
			<tbody id="trow">
				<tr>
					<th scope="row">1</th>
					<td>
						<?php
						echo "<select name=name1 onchange=getQuantity(this) class='1 form-select' >";
						echo "<option value=''>Select Item</option>";
						$array_values = array();
						while ($row = $res->fetch_assoc()) {
							$value = $row['item'];
							array_push($array_values, $value);
							echo "<option value='" . $value . "'>" . $value . "</option>";
						}
						echo "</select>";
						?>
					</td>
					<td>
						<input class="form-control" type="text" name="available1" disabled="true" />
					</td>
					<td>
						<input type="text" id="aaa" onchange="addValue(this)" class="1 form-control" name="rmk1" placeholder="RMK" />
					</td>
					<td>
						<input type="text" id="aaa" onchange="addValue(this)" class="1 form-control" name="rmd1" placeholder="RMD" />
					</td>
					<td>
						<input type="text" id="aaa" onchange="addValue(this)" class="1 form-control" name="rmkcet1" placeholder="RMKCET" />
					</td>
					<td>
						<input type="text" id="aaa" onchange="addValue(this)" class="1 form-control" name="school1" placeholder="SCHOOL" />
					</td>

				</tr>
				<tr id="dynamic_data1"></tr>
			</tbody>
		</table>
			</div>
		</div>
	</div>
		






		<br>
		<center>

			<div onclick="addForm()" type="button" class="btn btn-outline-success">ADD</div>
		</center>
		<center><button type="submit" onclick="checkDate()" class="btn btn-outline-primary mt-3">SUBMIT</button></center>
	</form>


	<script type="text/javascript">
		var counter = 2;

		function addForm() {
			var datas = <?php echo json_encode($array_values); ?>;
			for (let i = 0; i < 20; i++) {
				node = "";
				node += '<th class="" scope="row">' + counter + ' </th>';
				node += '<td><select type="text" name="name' + counter + '" class="' + counter + ' form-select" onchange="getQuantity(this)">';
				node += '<option value="">Select Item</option>';
				for (let i = 0; i < datas.length; i++) {
					node += '<option value="' + datas[i] + '">' + datas[i] + '</option>';
				}
				node += '</select></td><td><input type="text" class="form-control" name="available' + counter + '" disabled="true" /></td><td><input type="text" onchange="addValue(this)" class="' + counter + ' form-control" name="rmk' + counter + '" placeholder="RMK"/></td><td><input type="text" onchange="addValue(this)" class="' + counter + ' form-control" name="rmd' + counter + '" placeholder="RMD"/></td><td><input type="text" onchange="addValue(this)" class="' + counter + ' form-control" name="rmkcet' + counter + '" placeholder="RMKCET"/></td><td><input type="text" onchange="addValue(this)" class="' + counter + ' form-control" name="school' + counter + '" placeholder="SCHOOL"/></td>';
				document.getElementById('dynamic_data' + (counter - 1)).innerHTML += node;
				document.getElementById('trow').innerHTML += '<tr id="dynamic_data' + counter + '"></tr>';
				counter++;
			}
		}

		function addValue(node) {
			var itemNumber = node.className;
			itemNumber = itemNumber.split(" ")[0];
			var values = node.value;
			var existingValue = document.forms["entryForm"]["available" + itemNumber].value;

			if (existingValue - values < 0)
				alert("Dispatch Value does not exist");
			else
				document.forms["entryForm"]["available" + itemNumber].value = existingValue - values;
		}

		function getQuantity(node) {
			var itemNumber = node.className;
			itemNumber = itemNumber.split(" ")[0];
			var item = node.value;
			console.log(item, itemNumber);
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.forms["entryForm"]["available" + itemNumber].value = this.responseText;
				}
			};
			xhttp.open("POST", "available-stock-particular-item.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var params = "item=" + item;
			xhttp.send(params);
		}

		function checkDate() {
			if (!document.getElementByName("date").value)
				alert("Please Select any date");
		}
	</script>
</body>

</html>