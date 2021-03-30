<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width-device-width", initial-scale=1">
    <title>Airline</title>
    <link rel="shortcut icon" href="icons/plane.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="index.js"></script>
</head>
<body>
    <!--Navigation Bar-->
    <div id="topbar">
        <a class="active" href="http://localhost/airlineWebApplication/airline.php">Home</a>
        <a class="#Add" href="#Add">Add</a>
        <a class="#Update" href="#Update">Update</a>
        <a class="#Select" href="#Select">Select</a>
    </div>
    <!-- PHP Connection -->
    <?php
    include 'connectdb.php';
    ?>
    <!--Body-->
    <div class="content">
<?php
$airlineCode = $_POST["airlineChoose"];
$flightNum = $_POST["flightNum"];
$chooseDepart = $_POST["chooseDepart"];
$chooseArrival = $_POST["chooseArrival"];
$scheduledDepart = $_POST["scheduledDepart"];
$scheduledArrival = $_POST["scheduledArrival"];
// Fix weekdays
echo $chooseArrival;
?>
</ol>
<?php
$connection= NULL;
?>
    </div>
</body>
</html>