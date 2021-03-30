<?php
        $result = $connection -> query("SELECT AirlineCode FROM Airline");
        echo "<select>";
        echo "<option></option>";
        while ($row = $result->fetch()) {
            echo "<option>".$row["AirlineCode"]."</option>";
        }
        echo "</select>";
    ?>