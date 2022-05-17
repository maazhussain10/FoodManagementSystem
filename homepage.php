<?php
session_start();
if (!isset($_SESSION['uname'])) {
    echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <style>
        .top-left {
            position: absolute;
            top: 75px;
            left: 600px;
        }

        .container .content {
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #f1f1f1;
            width: 100%;
            padding: 20px;
        }

        .container .content1 {
            position: absolute;
            top: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #f1f1f1;
            width: 100%;
            padding: 20px;
        }

        body {
            background-image: url("rmk22.gif");
            height: 100%;
            width: 90%;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        #mySidenav a {
            position: absolute;
            left: -200px;
            transition: 0.3s;
            padding: 15px;
            width: 200px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            border-radius: 0 5px 5px 0;
        }

        #mySidenav a:hover {
            left: 0;
        }

        #about {
            top: 140px;
            background-color: #4CAF50;
        }

        #blog {
            top: 200px;
            background-color: #2196F3;
        }

        #projects {
            top: 260px;
            background-color: #f44336;
        }

        #contact {
            top: 320px;
            background-color: #A569BD
        }

        #item {
            top: 500px;
            background-color: #A569BD
        }

        #cate {
            top: 380px;
            background-color: #555
        }

        #ven {
            top: 440px;
            background-color: #f44336
        }

        #call {
            top: 560px;
            background-color: #4CAF50
        }
    </style>
</head>

<body>

    <div class="offcanvas offcanvas-top" style="max-height: 99px;" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <!-- <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div> -->
        <div class="offcanvas-bod">
            <!-- <div id="mySidenav" class="sidenav">
                <a href="purchase.php" id="about">Purchase</a>
                <a href="dispatch.php" id="blog">Dispatch</a>
                <a href="available.php" id="projects">Available stock</a>
                <a href="dateselect.php" id="contact">Datewise report</a>
                
                <a href="category.php" id="cate">Category Management</a>
                <a href="vendors.php" id="ven">Vendor Management</a>
                <a href="attendence.php" id="item">Attendence</a>
                <a href="index.php" id="call">Logout</a>
            </div> -->
            <?php include 'nav.php'; ?>
        </div>
    </div>

    <div style="margin-left:-10px;">
        <div class="container">

            <div class="">
                <center class="mt-md-4 mt-sm-5 pt-sm-5 pt-md-1"><img src="./assets/img/rmk.png" alt="" width="300" height="100" class="img-fluid "></center>


            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button class="btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Open Operations</button>



        </div>
    </div>
</body>

</html>