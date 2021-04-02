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
        <a class="#Update" href="http://localhost/airlineWebApplication/update.php">Update</a>
        <a class="#Select" href="http://localhost/airlineWebApplication/select.php">Select</a>
    </div>
    <!-- PHP Connection -->
    <?php
    include 'connectdb.php';
    ?>
    <!--Body-->
    <div class="content">
        <div class="update">
            <h2>Update a Flight's Actual Departure Time:</h2>
            <form action="#" method="post">
                <!-- Airline Code Input -->
                <?php
                    $result = $connection -> query("SELECT ALineCode, FlightNum FROM Flight");
                    echo "<label for='flightChoose'>Choose a flight: </label>";
                    echo "<select id='flightChoose' name='flightChoose' class='big'>";
                    echo "<option></option>";
                    while ($row = $result->fetch()) {
                        echo "<option>".$row["ALineCode"].$row["FlightNum"]."</option>";
                    }
                    echo "</select><br><br>";
                ?>
                <!-- Flight Number Input-->
                <label for="departureTime">Enter A Depature Time:</label>
                <input type="text" id="departureTime" placeholder="hh:mm:ss" name="departureTime" class="big"><br><br>
                <input type="submit" name="flightSubmit" value="Update Time" class="big">
            </form>
        </div>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $actualDepart = $_POST["departureTime"];
                $flightCode = $_POST["flightChoose"];
                $airlineCode = preg_replace("/[^a-zA-Z]+/", "", $flightCode);
                $num = preg_replace('~\D~', '', $flightCode);
                $query = "UPDATE Flight SET ActualDeparture ='".$actualDepart."' WHERE FlightNum='".$num."' AND ALineCode='".$airlineCode."'";
                $result = $connection -> query($query);
                
                function alertMsg($message) {
                    echo "<script>alert('$message');</script>";
                }
                alertMsg("Flight Updated Successfully");
                $connection = NULL;
            }
        ?>
    </div>
</body>
</html>