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
<!-- PHP Connection -->
<?php
include 'connectdb.php';
?>
    <!--Navigation Bar-->
    <div id="topbar">
        <a class="active" href="http://localhost/airlineWebApplication/airline.php">Home</a>
        <a class="#Add" href=http://localhost/airlineWebApplication/add.php>Add</a>
        <a class="#Update" href="http://localhost/airlineWebApplication/update.php">Update</a>
        <a class="#Select" href="http://localhost/airlineWebApplication/select.php">Select</a>
    </div>
    <!--Body-->
    <div class="content">
        <div class="select">
            <h2>View the average number of seats</h2> 
            <p>Displays the average number of seats available on all flights on a specific day</p>
            <form action="#" method="post">
                <label for="dayOfWeek">Enter a day of the week:</label>
                <input type="text" id="dayOfWeek" maxlength="9" name="dayOfWeek" class="big">
                <input type="submit" name="dateSubmit"class="big">
            </form>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $whichDay=$_POST["dayOfWeek"];
                
                $result = $connection -> query('SELECT AVG(MaxSeat) as "AvgSeats" 
                FROM Flight 
                LEFT OUTER JOIN Airplane ON FLight.APlaneID = Airplane.AirplaneID 
                LEFT OUTER JOIN AirplaneType ON Airplane.ATypeName = AirplaneType.TypeName 
                Inner JOIN DaysOffered ON Flight.ALineCode=DaysOffered.ALineCode AND OfferedDays = "'.$whichDay.'"');
                $row=$result->fetch();
                $numSeats = (int)$row["AvgSeats"];
                echo "<br><br><p>The average number of seats on ".$whichDay." is: ".$numSeats." seats</p>";
            
            }
            
            ?>
            <?php
            $connection = NULL;
            ?>
        </div>
    </div>
</body>
</html>