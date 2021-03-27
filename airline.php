<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width-device-width", initial-scale=1">
    <title>Airline</title>
    <link rel="shortcut icon" href="icons/plane.png">
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body>
<!-- PHP Connection -->
<?php
include 'connectdb.php';
?>
    <!--Navigation Bar-->
    <div id="topbar">
        <a class="active" href="#home">Home</a>
    </div>
    <!--Body-->
    <div class="content">
        <!--Browse Flights-->
        <div class="browse">
            <h2>Browse Flights</h2>
            <form>
                <input type="text" placeholder="Enter Airline Code Here" name="airlinecode">
                <input type="date" name="airlinedate" id="airlinedate">
                <input type="submit" name="airlinesubmit">
            </form>
        </div>
        <!--Add Flights-->
        <div class="add">
            <h2>Add Flights</h2>
        </div>
    </div>
</body>
</html>