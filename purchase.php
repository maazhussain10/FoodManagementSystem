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
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    * {
      font-weight: bold;
    }

    .form-control {
      font-size: 15px;
      color: black;
    }

    body {
      background-color: #CBFFC2;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <?php include 'nav.php'; ?>
    <?php
    include('dbConnect.php');
    $smt = $con->prepare("select distinct(item) from category order by item;");
    $smt->execute();
    $res = $smt->get_result();
    ?>

    <h1 class="text-center pt-5">Enter the Item</h1>
    <form class="form-floating" action="fil.php" name="entryForm" method="post">
      <div class="row">
        <div class="col-sm-4 offset-sm-4">
          <center class="mb-5 text-center" style="widht:50%">
            <label for="date" class="form-label">Enter Date</label>
            <input class="form-control" type="date" id="date" name="date" placeholder="Select date" />
          </center>
        </div>
      </div>

      <table class="table table-light">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" style="">Select</th>
            <th scope="col">Category</th>
            <th scope="col">Vendor</th>
            <th scope="col">Quantity</th>
            <th scope="col">Amount</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">
              1
            </th>
            <td>
              <?php
              echo "<select name=name1 onchange=getCategory(this) class='1 form-select' style=' height:50px'>";
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
              <input class="form-control" type="text" id="qty1" onchange="addValue(this)" class="1" name="qty1" placeholder="Quantity" />
            </td>
            <td>
              <input class="form-control" type="text" id="amt1" onchange="addValue(this)" class="1" name="amt1" placeholder="Amount/Kg" />
            </td>
            <td>
              <input class="form-control" type="text" class="1" name="total1" placeholder="Total Amount" readonly="readonly" />
            </td>
          </tr>
          <center>
            <div id="dynamic_data1"></div>
            <div onclick="addForm()" type="button" class="btn btn-success">ADD</div>
          </center>
          <br>
          <center>
            <input class="form-control" type="submit" onclick="checkDate()" class="btn btn-primary">
          </center>
    </form>
    <center><a href="homepage.php">Home</a></center>

    <script>
      var counter = 2;

      function addForm() {

        var datas = <?php echo json_encode($array_values); ?>;
        for (let i = 0; i < 20; i++) {
          node = "";
          node += '<tr><th scope="row">' + counter + ' </th>';
          node += '<td><select type="text" name="name' + counter + '" class="form-select "+ ' + counter + ' onchange="getCategory(this)" style="color:red; height:40px">';
          node += '<option value="">Select Item</option>';
          for (let i = 0; i < datas.length; i++) {
            node += '<option value=' + datas[i] + '>' + datas[i] + '</option>';
          }
          node += '</select></td><td><input type="text" name="category' + counter + '" readonly="readonly" /></td><td><input type="text" id="aaa1" name="vendor' + counter + '" readonly="readonly" /></td><td><input type="text" id="qty' + counter + '" onchange="addValue(this)" class=' + counter + ' name="qty' + counter + '" placeholder="Quantity" /></td><td><input type="text" id="amt' + counter + '" onchange="addValue(this)" class=' + counter + ' name="amt' + counter + '" placeholder="Amount/Kg"/></td><td><input type="text" class=' + counter + ' name="total' + counter + '" placeholder="Total Amount" readonly="readonly"/></td><br><br></tr><div id="dynamic_data' + counter + '"></div>';
          document.getElementById('dynamic_data' + (counter - 1)).innerHTML += node;
          counter++;
        }
        node += '</tbody></table>';
      }

      function checkDate() {
        if (!document.getElementByName("date").value)
          alert("Please Select any date");
      }

      function addValue(node) {
        var itemNumber = node.className;
        console.log(itemNumber);
        var quantity = document.getElementById('qty' + itemNumber).value;
        var amount = document.getElementById('amt' + itemNumber).value;
        console.log(quantity, amount);
        document.forms["entryForm"]["total" + itemNumber].value = quantity * amount;
      }

      function getCategory(node) {
        var itemNumber = node.className;
        var item = node.value;
        console.log(item, itemNumber);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
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
        var item = node.value;
        console.log("evsdv", item, category);
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