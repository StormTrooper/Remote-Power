<html>
<head>
<title>Computer Power Manager</title>
</head>
<body>

<h2>Server Status</h2>

<?php
$myfile = fopen("computers.txt", "r") or die("Unable to open file!");
?>
<table Cellpadding="10"> 


<?php

if ($myfile) {
	while(($line = fgets($myfile)) !== false) {
		$arr = explode(',',$line);
		$computer = $arr[0];
		$power = $arr[1];
		$reset = $arr[2]; 
?>

	<tr>
        	<td><h3><?php echo $computer; ?></h3></td>
	        <td>

		<?php
	        $updown = exec("fping  -i 150 -t 150 $computer | awk ' {print$3} ' "); #pings PC
		if ( $updown == "alive" )
                        {
                                echo "<img src='images/green-power-button.jpg' width=50 border=0>";
                        }
                else
                        {
                                echo "<img src='images/red-power-button.jpg' width=50 border=0>";
                        }

        	?></td>

        <td><a href="./resetconfirm.php?computer=<?php echo $computer; ?>&pin=<?php echo $reset; ?>"><IMG SRC="/images/reset.png" onclick="return confirm('Are you sure?');" width='55' ALT="Reset Computer"></a></td>
        <td><a href="./power.php?computer=<?php echo $computer; ?>&pin=<?php echo $power; ?>"><IMG SRC="/images/power-button.png" width='55' ALT="Reset Computer"></a></td>




<?php 

	}

}


fclose($myfile);

?>

</table>







        <h3>Raspberry Pi Status</h3>

        <?php 
                $temp = exec('/opt/vc/bin/vcgencmd measure_temp'); #runs temperature command
                $tempjunk = array("temp=");
                $tempclean = str_replace($tempjunk, "", $temp); #removes extra letters and equals sign
                echo "<b>System Temperature:</b> $tempclean"; # displays it all pretty
        ?>
        <br>
        <?php 
                $cpu = exec(" cat /proc/loadavg | awk ' {print $1, $2, $3} ' "); #scrapes the 8th, 9th, and 10th words from the uptime command
                $cpujunk = array("load average:");
                $cpuclean = str_replace($cpujunk, "", $cpu);
                echo "<b>Load Averages:</b> $cpuclean";
        ?>
        <br>
        <?php 
                $ram = exec("free -h | grep Mem |  awk ' {print$2,$3,$4} ' ");
                $ramclean = str_replace("M", "MB", $ram);
                echo "<b>Memory Usage (total, used, free):</b> $ramclean<p>";


	$uptime_array = explode(" ", exec("cat /proc/uptime"));
	$seconds = round($uptime_array[0], 0);
	$minutes = $seconds / 60;
	$hours = $minutes / 60;
	$days = floor($hours / 24);
	$hours = sprintf('%02d', floor($hours - ($days * 24)));
	$minutes = sprintf('%02d', floor($minutes - ($days * 24 * 60) - ($hours * 60)));
	if ($days == 0):
		$uptime = $hours . ":" .  $minutes;
	elseif($days == 1):
		$uptime = $days . " day, " .  $hours . ":" .  $minutes;
	else:
		$uptime = $days . " days, " .  $hours . ":" .  $minutes;
	endif;

	echo "<b>Uptime:</b> " . $uptime;
        ?>
</body>
</html>
