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
    $airplaneID = $_POST["airplaneID"];
    $chooseDepart = $_POST["chooseDepart"];
    $chooseArrival = $_POST["chooseArrival"];
    $scheduledDepart = $_POST["scheduledDepart"];
    $scheduledArrival = $_POST["scheduledArrival"];
    $weekdays = $_POST['check_list']; //Weekday array
    
    $query= 'INSERT INTO Flight 
    (FlightNum, 
    ScheduledArrival,
    ScheduledDeparture,
    ALineCode,
    APlaneID,
    APortDepart,
    APortArrival) values(
        "'.$flightNum .'",
        "'.$scheduledArrival.'",
        "'.$scheduledDepart.'",
        "'.$airlineCode.'",
        "'.$airplaneID.'",
        "'.$chooseDepart.'",
        "'.$chooseArrival.'"
    )';

    //Insert Data into DaysOffered
   
    $result = $connection->exec($query);
    echo "Your flight was added!";
    $connection=NULL;
?>
</ol>
    </div>
</body>
</html>