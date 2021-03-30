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
        <a class="#Add" href=http://localhost/airlineWebApplication/add.php>Add</a>
        <a class="#Update" href="#Update">Update</a>
        <a class="#Select" href="#Select">Select</a>
    </div>
    <!-- PHP Connection -->
    <?php
    include 'connectdb.php';
    ?>
    <!--Body-->
    <div class="content">
        <div class="punctual">
            <h3>Flights That Are On Time!</h3>
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
                echo "Sorry no flights are on time :(";
            }
            ?>
            </table>
        </div>
        <!--Browse Flights-->
        <div class="browse">
            <h2>Browse Flights</h2>
            <form action="browse.php" method="post">
                <input type="text" placeholder="Enter Airline Code Here" name="airlinecode" class="big">
                <input type="text" placeholder="Day of the week Here" name="airlinedate" id="airlinedate" class="big">
                <input type="submit" value="Get Flights" class="big">
            </form>
        </div>
        <!--Add Flights-->
        <div class="add">
            <h2>Add Flights</h2>
            <form action="add.php" method="post">
            <!-- Airline Code Input -->
            <?php
                $result = $connection -> query("SELECT AirlineCode FROM Airline");
                echo "<label for='airlineChoose'>Choose an Airline: </label>";
                echo "<select id='airlineChoose' name='airlineChoose' class='big'>";
                echo "<option></option>";
                while ($row = $result->fetch()) {
                    echo "<option>".$row["AirlineCode"]."</option>";
                }
                echo "</select>   ";
            ?>
            <label for="flightNum">Flight Number</label>
            <input type="text" id="flightNum" maxlength="3" placeholder="Enter a 3-digit number"name="flightNum" class="big"><br><br>
            <!-- Departure Airport Code Input -->
            <?php
                $result = $connection -> query("SELECT AirportCode FROM Airport");
                echo "<label for='chooseDepart'>Choose a Departure Airport: </label>";
                echo "<select id='chooseDepart' name='chooseDepart' class='big'>";
                echo "<option></option>";
                while ($row = $result->fetch()) {
                    echo "<option>".$row["AirportCode"]."</option>";
                }
                echo "</select> ";
            ?>
            <!-- Arrival Airport Code Input -->
            <?php
                $result = $connection -> query("SELECT AirportCode FROM Airport");
                echo "<label for='chooseArrival'>Choose an Arrival Airport: </label>";
                echo "<select id='chooseArrival' name='chooseArrival' class='big'>";
                echo "<option></option>";
                while ($row = $result->fetch()) {
                    echo "<option>".$row["AirportCode"]."</option>";
                }
                echo "</select><br><br>";
            ?>
            <label for="scheduledDepart">Departure Time</label>
            <input type="text" id="scheduledDepart" placeholder="hh:mm:ss" name="scheduledDepart" class="big">
            <label for="scheduledArrival">Arrival Time</label>
            <input type="text" id="scheduledArrival" placeholder="hh:mm:ss" name="scheduledArrival" class="big">
            
            <!-- Select Weekdays-->
            <h4>Select Days of the Week Offered:</h4>
            <div class="weekDays-selector">
                <input type="checkbox" id="weekday-mon" name="weekday" class="weekday" value="Monday">
                <label for="weekday-mon">M</label>
                <input type="checkbox" id="weekday-tue" name="weekday" class="weekday" value="Tuesday">
                <label for="weekday-tue">T</label>
                <input type="checkbox" id="weekday-wed" name="weekday" class="weekday" value="Wednesday">
                <label for="weekday-wed">W</label>
                <input type="checkbox" id="weekday-thu" name="weekday" class="weekday" value="Thursday">
                <label for="weekday-thu">T</label>
                <input type="checkbox" id="weekday-fri" name="weekday" class="weekday" value="Friday">
                <label for="weekday-fri">F</label>
                <input type="checkbox" id="weekday-sat" name="weekday" class="weekday" value="Saturday">
                <label for="weekday-sat">S</label>
                <input type="checkbox" id="weekday-sun" name="weekday" class="weekday" value="Sunday">
                <label for="weekday-sun">S</label>
            </div>
            <br>
            <input type="submit" name="submit" value="Add Flights" class="big">
            </form>
        </div>
        <?php
                $connection= NULL;
            ?>
    </div>
</body>
</html>