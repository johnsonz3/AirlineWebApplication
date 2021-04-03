<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width-device-width", initial-scale=1">
    <title>Airline</title>
    <link rel="shortcut icon" href="icons/plane.png">
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <div class="browse">
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
                echo "<h2>Flights scheduled on: $whichDate </h2>";
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
    </div>
</body>
</html>