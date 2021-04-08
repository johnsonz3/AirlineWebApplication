<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width-device-width", initial-scale=1">
    <title>Airline</title>
    <link rel="shortcut icon" href="icons/plane.png">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
    <!--Add Flights-->
    <div class="add">
        <h2>Create a Flight</h2><br>
        <form action="#" method="post">
        <!-- Airline Code Input -->
        <?php
            $result = $connection -> query("SELECT AirlineCode FROM Airline");
           
            echo "<select id='airlineChoose' name='airlineChoose' class='big'>";
            echo "<option disabled selected value>Choose an Airline: </option>";
            while ($row = $result->fetch()) {
                echo "<option>".$row["AirlineCode"]."</option>";
            }
            echo "</select>   ";
        ?>
        <!-- Flight Number Input-->
        <label for="flightNum">Flight Number:</label>
        <input type="text" id="flightNum" maxlength="3" placeholder="Enter a 3-digit number"name="flightNum" class="big">
            
        <!-- Airplane ID Input-->
        <label for="airplaneID">Airplane ID:</label>
        <input type="text" id="airplaneID" maxlength="5" placeholder="Enter Airplane ID"name="airplaneID" class="big">
        <br><br>
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
        <label for="scheduledDepart">Departure Time:</label>
        <input type="text" id="scheduledDepart" placeholder="hh:mm:ss" name="scheduledDepart" class="big">
        <label for="scheduledArrival">Arrival Time:</label>
        <input type="text" id="scheduledArrival" placeholder="hh:mm:ss" name="scheduledArrival" class="big">
            
        <!-- Select Weekdays-->
        <h4>Select Days of the Week Offered:</h4>
        <div class="weekDays-selector">
            <input type="checkbox" id="weekday-sun" name="check_list[]" class="weekday" value="Sunday">
            <label for="weekday-sun">Sun</label>
            <input type="checkbox" id="weekday-mon" name="check_list[]" class="weekday" value="Monday">
            <label for="weekday-mon">Mon</label>
            <input type="checkbox" id="weekday-tue" name="check_list[]" class="weekday" value="Tuesday">
            <label for="weekday-tue">Tue</label>
            <input type="checkbox" id="weekday-wed" name="check_list[]" class="weekday" value="Wednesday">
            <label for="weekday-wed">Wed</label>
            <input type="checkbox" id="weekday-thu" name="check_list[]" class="weekday" value="Thursday">
            <label for="weekday-thu">Thu</label>
            <input type="checkbox" id="weekday-fri" name="check_list[]" class="weekday" value="Friday">
            <label for="weekday-fri">Fri</label>
            <input type="checkbox" id="weekday-sat" name="check_list[]" class="weekday" value="Saturday">
            <label for="weekday-sat">Sat</label>
        </div>
        <br>
        <input type="submit" name="addSubmit" value="Add Flight to Database" class="big">
        </form>
    </div>
<?php
    if(isset($_POST['addSubmit'])){
        $airlineCode = $_POST["airlineChoose"];
        $flightNum = $_POST["flightNum"];
        $airplaneID = $_POST["airplaneID"];
        $chooseDepart = $_POST["chooseDepart"];
        $chooseArrival = $_POST["chooseArrival"];
        $scheduledDepart = $_POST["scheduledDepart"];
        $scheduledArrival = $_POST["scheduledArrival"];
        $weekdays = $_POST['check_list']; //Weekday array
        
        // Airplane ID Check
        $result = $connection ->query("SELECT COUNT(*) as NumCount FROM Airplane WHERE AirplaneID='".$airplaneID."' AND
        ALineCode='".$airlineCode."'");
        $row = $result->fetch();
        // Insert data into Airplane if the airplane model does not exist
       
        if($row["NumCount"]==0){
            $result3 = $connection -> exec('INSERT INTO Airplane (
                    AirplaneID,
                    ALineCode,
                    ATypeName) values(
                    "'.$airplaneID.'",
                    "'.$airlineCode.'",
                    "Boeing 737-800"
                )');
        } 
       
        $query= 'INSERT INTO Flight (
        FlightNum, 
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
        // Insert Data Into Flights
        try{
            $result = $connection->exec($query);
        }catch(exception $e){
            echo "<script>
                alert('Error, you flight could not be added!');
            </script>";
        }

        //Insert Data into DaysOffered
        for ($i=0; $i < sizeof($weekdays); $i++) {
            $query2= 'INSERT INTO DaysOffered(
                FlightNumber,
                ALineCode,
                OfferedDays) values(
                    "'.$flightNum.'",
                    "'.$airlineCode.'",
                    "'.$weekdays[$i].'")';
            try{
                $result2 = $connection->exec($query2);
            }catch(exception $e){
                echo "<script>
                    alert('Error, you flight could not be added!');
                </script>";
            }
            
        }
        echo "<script>
                alert('Your Flight was Added!');
        </script>";
        
        $connection=NULL;
    }
?>
</ol>
    </div>
</body>
</html>