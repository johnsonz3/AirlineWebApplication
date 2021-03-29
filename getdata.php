<?php
        $result = $connection -> query("SELECT Flight.FlightNum, Flight.APortDepart, Flight.APortArrival  
        FROM Flight, DaysOffered 
        WHERE FlightNum=FlightNumber ");
        echo "<ol>";
        while ($row = $result->fetch()) {
            echo "<li>";
            echo $row["APortDepart"]." - ";
            echo $row["FlightNum"]."</li>";
        }
    echo "</ol>";
    ?>