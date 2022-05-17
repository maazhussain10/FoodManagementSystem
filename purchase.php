<?php
session_start();
if (!isset($_SESSION['uname'])) {
  echo "<script>window.location.href='index.php';</script>";
}
include('dbConnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Purchase</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <style>
    /* * {
      font-weight: bold;
    } */

    

    /* body {
      background-color: #CBFFC2;
    } */
  </style>
</head>

<body>

  <?php include 'nav.php'; ?>
  <?php
  include('dbConnect.php');
  $smt = $con->prepare("select distinct(item) from category order by item;");
  $smt->execute();
  $res = $smt->get_result();
  ?>
  <div class="container-fluid">


    <h3 class="text-center pt-5">Enter the Item</h3>
    <form class="form-floating" action="fil.php" name="entryForm" method="post">
      <div class="row">
        <div class="col-sm-4 offset-sm-4">
          <center class="mb-5 text-center">
            <label for="date" class="form-label">Enter Date</label>
            <input class="form-control" type="date" id="date" name="date" placeholder="Select date" />
          </center>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-10 offset-sm-1">
          <div class="table-responsive">
            <table class="table table-light">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Select</th>
                  <th scope="col">Category</th>
                  <th scope="col">Vendor</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody id="trow">
                <tr>
                  <th scope="row">
                    1
                  </th>
                  <td>
                    <?php
                    echo "<select name=name1 onchange=getCategory(this) class='1 form-select' >";
                    echo "<option value=''>Select Item</option>";
                    $array_values = array();
                    while ($row = $res->fetch_assoc()) {
                      $value = $row['item'];
                      array_push($array_values, $value);
                      echo "<option value='" . $value . "' style='height:40px'>" . $value . "</option>";
                    }
                    echo "</select>";
                    ?>
                  </td>
                  <td>
                    <input class="form-control" type="text" id="aaa" name="category1" readonly="readonly" />
                  </td>
                  <td>
                    <input class="form-control" type="text" id="aaa1" name="vendor1" readonly="readonly" />
                  </td>
                  <td>
                    <input class="1 form-control" type="text" id="qty1" onchange="addValue(this)" name="qty1" placeholder="Quantity" />
                  </td>
                  <td>
                    <input class="1 form-control" type="text" id="amt1" onchange="addValue(this)" name="amt1" placeholder="Amount/Kg" />
                  </td>
                  <td>
                    <input class="1 form-control" type="text" name="total1" placeholder="Total Amount" readonly="readonly" />
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
        <br>
        <button type="submit" onclick="checkDate()" class="btn btn-outline-primary mt-3 mb-3">SUBMIT</button>
      </center>
    </form>

  </div>
  <script>
    var counter = 2;

    function addForm() {

      var datas = <?php echo json_encode($array_values); ?>;
      for (let i = 0; i < 20; i++) {

        node = "";
        node += '<th class="" scope="row">' + counter + ' </th>';
        node += '<td><select type="text" name="name' + counter + '" class="' + counter + ' form-select" onchange="getCategory(this)" >';
        node += '<option value="">Select Item</option>';
        for (let i = 0; i < datas.length; i++) {
          node += '<option value="' + datas[i] + '">' + datas[i] + '</option>';
        }
        node += '</select></td><td><input type="text" class="form-control" name="category' + counter + '" readonly="readonly" /></td><td><input type="text" class="form-control" id="aaa1" name="vendor' + counter + '" readonly="readonly" /></td><td><input type="text" id="qty' + counter + '" onchange="addValue(this)" class="' + counter + ' form-control" name="qty' + counter + '" placeholder="Quantity" /></td><td><input type="text" id="amt' + counter + '" onchange="addValue(this)" class="' + counter + ' form-control" name="amt' + counter + '" placeholder="Amount/Kg"/></td><td><input type="text" class="' + counter + ' form-control" name="total' + counter + '" placeholder="Total Amount" readonly="readonly"/></td>';
        document.getElementById('dynamic_data' + (counter - 1)).innerHTML += node;
        document.getElementById('trow').innerHTML += '<tr id="dynamic_data' + counter + '"></tr>';
        counter++;
      }

    }

    function checkDate() {
      if (!document.getElementByName("date").value)
        alert("Please Select any date");
    }

    function addValue(node) {
      var itemNumber = node.className;
      itemNumber = itemNumber.split(" ")[0];
      console.log(itemNumber);
      var quantity = document.getElementById('qty' + itemNumber).value;
      var amount = document.getElementById('amt' + itemNumber).value;
      console.log(quantity, amount);
      document.forms["entryForm"]["total" + itemNumber].value = quantity * amount;
    }

    function getCategory(node) {
      var itemNumber = node.className;
      itemNumber = itemNumber.split(" ")[0];
      var item = node.value;
      console.log(item, itemNumber);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          document.forms["entryForm"]["category" + itemNumber].value = this.responseText;
          getVendor(node, this.responseText);
        }
      };
      xhttp.open("POST", "category_search.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var params = "item=" + item;
      xhttp.send(params);
    }

    function getVendor(node, category) {
      // Find Vendor For this Category
      var itemNumber = node.className;
      itemNumber = itemNumber.split(" ")[0];
      var item = node.value;

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText)
            document.forms["entryForm"]["vendor" + itemNumber].value = this.responseText;
          else
            document.forms["entryForm"]["vendor" + itemNumber].value = "No Vendor Found";
        }
      };
      xhttp.open("POST", "viewvendor.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var params = "category=" + category;
      xhttp.send(params);
    }
  </script>
</body>

</html>