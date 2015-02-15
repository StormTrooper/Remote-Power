<?php
$computer = htmlspecialchars($_GET["computer"]);
$pin = htmlspecialchars($_GET["pin"]);
?>


<html>
<head>
<title>Computer Power Manager</title>
</head>
<body>
        <?php 
                $updown = exec("fping  -i 150 -t 150 $computer | awk ' {print$3} ' "); #pings PC and returns either an error or PC is alive. Scrapes the 3rd word, alive
                if ( $updown == "alive" )
                        {
                                echo "<b>$computer is already on.</b>"; # displays action
                        }
                else
                        {
                                exec('sudo python /usr/scripts/power.py $pin'); #runs python script
                                echo "<b>$computer has been turned on.</b>"; # displays action
                        }
        ?>
        
        <form>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
    </form>
</form>
</body>
</html>
