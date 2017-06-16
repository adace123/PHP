<html>
    <title>City Population Table</title>
    <body>
        <?php
        
        $city_pop = array('New York, NY' => 8175133, 
        'Los Angeles, CA' => 3792621,
        'Chicago, IL' => 2695598,
        'Houston, TX' => 2100263,
        'Philadelphia, PA' => 1526006,
        'Phoeniz, AZ' => 1445632,
        'San Antonio, TX' => 1327407,
        'San Diego, CA' => 1307402,
        'Dallas, TX' => 1197816,
        'San Jose, CA' => 945942);
        echo "<table style='margin:0 auto;border:2px solid;text-align:center;'>";
        echo '<th>City</th><th>Population</th>';
        foreach($city_pop as $city => $pop){
            echo "<tr style='border:2px solid;'><td style='border:2px solid;'>$city</td><td style='border:2px solid;'>$pop</td></tr>";
        }
        echo "<tr style='colspan:2'><td>Total population: ".array_sum(array_values($city_pop))."</td></tr>";
        echo '</table>';
        echo "<h1 style='text-align:center'>Cities Ordered By Population</h1>";
        echo "<table style='margin:0 auto;border:2px solid;text-align:center;'>";
        echo '<th>City</th><th>Population</th>';
        asort($city_pop);
        foreach($city_pop as $city => $pop){
            echo "<tr style='border:2px solid;'><td style='border:2px solid;'>$city</td><td style='border:2px solid;'>$pop</td></tr>";
        }
        echo "</table>";
        
        ksort($city_pop);
        echo '</table>';
        echo "<h1 style='text-align:center'>Cities Ordered By City Name</h1>";
        echo "<table style='margin:0 auto;border:2px solid;text-align:center;'>";
        echo '<th>City</th><th>Population</th>';
        foreach($city_pop as $city => $pop){
            echo "<tr style='border:2px solid;'><td style='border:2px solid;'>$city</td><td style='border:2px solid;'>$pop</td></tr>";
        }
        echo "</table>";
        
         getTotalPopByState("CA");
        
        function getTotalPopByState($state){
            $sum = 0;
            global $city_pop;
            foreach($city_pop as $city => $pop){
                $keyArray = explode(",",$city);
            if (trim($keyArray[1]) == $state){
                $sum += $pop;
            }
        }
        echo "<h1 style='text-align:center;'>".$state." Total Major City Population: ". $sum ."</h1>";
        }
        ?>
    </body>
</html>
