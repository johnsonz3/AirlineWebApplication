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
        <a class="#Add" href="#Add">Add</a>
        <a class="#Update" href="#Update">Update</a>
        <a class="#Select" href="#Select">Select</a>
    </div>
    <!--Body-->
    <div class="content">
        <table>
        <?php
        $whichAirline=$_POST["airlinecode"];
        $whichDate=$_POST["airlinedate"];
        
        $query = 'SELECT Flight.FlightNum, Flight.APortDepart, Flight.APortArrival  
        FROM Flight, DaysOffered 
        WHERE FlightNum=FlightNumber
        AND Flight.ALineCode="'.$whichAirline.'"
        AND DaysOffered.OfferedDays="'.$whichDate.'" ';
        
        $query = 'SELECT FlightNumber, 
        DaysOffered.ALineCode, 
        depart.city as departure, 
        arrive.city as arrival 
        FROM Flight 
        LEFT OUTER JOIN Airport as depart on Flight.APortDepart = depart.AirportCode 
        LEFT OUTER JOIN Airport as arrive on Flight.APortArrival = arrive.AirportCode 
        INNER JOIN DaysOffered on Flight.ALineCode = DaysOffered.ALineCode 
        AND FlightNum=FlightNumber 
        AND Flight.ALineCode="'.$whichAirline.'"
        AND DaysOffered.OfferedDays="'.$whichDate.'" ';
        
        $result=$connection->query($query);
        $row=$result->fetch();
        if($row){
            echo "<tr><h3>Date: $whichDate</h3></tr>";
            echo "<tr><th>Flight Code</th><th>Airport Departure Location</th><th>Airport Arrival Location</th></tr>";
            echo "<tr><td>".$row["ALineCode"].$row["FlightNumber"]."</td><td>".$row["departure"]."</td><td>".$row["arrival"]."</td></tr>";
            while ($row=$result->fetch()) {
                echo "<tr><td>".$row["ALineCode"].$row["FlightNumber"]."</td><td>".$row["departure"]."</td><td>".$row["arrival"]."</td></tr>";
            }
        }else {
            echo "<script>
            alert('There are no flights found');
            window.location.href='airline.php';
            </script>";
        }
        
        ?>
        </table>
        <?php
        $connection = NULL;
        ?>
    </div>
</body>
</html>