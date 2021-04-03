<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width-device-width", initial-scale=1">
    <title>Airline</title>
    <link rel="shortcut icon" href="icons/plane.png">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="main">
    <!--Navigation Bar-->
    <div id="topbar">
        <a class="active" href="http://localhost/airlineWebApplication/airline.php">Home</a>
        <a class="#Add" href=http://localhost/airlineWebApplication/add.php>Add</a>
        <a class="#Update" href="http://localhost/airlineWebApplication/update.php">Update</a>
        <a class="#Select" href="http://localhost/airlineWebApplication/select.php">Select</a>
    </div>
    <!-- PHP Connection -->
    <?php
    include 'connectdb.php';
    ?>
    <!--Body-->
    <div class="content">
        <div class="home">
        <div class="punctual">
            <h3>Flights That Are On Time!</h3>
            <p>A list of all flights whose scheduled arrival time matches their actual arrival time</p>
            <table>
            <?php
            $query = 'SELECT ALineCode,FlightNum, ActualArrival 
            FROM Flight
            WHERE ScheduledArrival=ActualArrival';
            
            $result=$connection->query($query);
            $row=$result->fetch();
            if($row){
                echo "<tr><th>Flight Codes</th><th>Arrival Times</th>";
                echo "<tr><td>".$row["ALineCode"].$row["FlightNum"]."</td><td>".$row["ActualArrival"]."</td></tr>";
                while ($row=$result->fetch()) {
                    echo "<tr><td>".$row["ALineCode"].$row["FlightNum"]."</td><td>".$row["ActualArrival"]."</td></tr>";
                }
            } else {
                echo "Sorry there are no flights that have arrived on time :(";
            }
            ?>
            </table>
        </div>
        <!--Browse Flights-->
        
        <h2>Browse Flights</h2>
        <form action="browse.php" method="post">
            <input type="text" maxlength=3 placeholder="Enter Airline Code Here" name="airlinecode" class="big">
            <input type="text" maxlength=9 placeholder="Day of the week Here" name="airlinedate" id="airlinedate" class="big">
            <input type="submit" value="Get Flights" class="big">
        </form>
        <?php
                $connection= NULL;
        ?>
        </div>
    </div>
</body>
</html>