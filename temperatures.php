<!DOCTYPE html>
<html>
    <title>Temperature Conversions</title>
    <body>
        <?php
           echo "<table style='margin:0 auto;border:2px solid;text-align:center;'>";
            echo "<th style='border:2px solid;'>Fahrenheit</th><th style='border:2px solid;'>Celsius</th>";
            $temp = -50;
            while($temp <= 50){
                if($temp != 0){
                  $backgroundColor = "white";
                }
                else{
                    $backgroundColor = "blue";
                }
                
                echo "<tr style='border:2px solid;background-color:$backgroundColor;'>
                      <td style='border:2px solid;'>$temp</td>
                      <td style='border:2px solid;'>".round(($temp-32)*(5/9),2)."</td>
                      </tr>";
                $temp += 5;
            }
            echo "</table>";
        ?>
    </body>
</html>
