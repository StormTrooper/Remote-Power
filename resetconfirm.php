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
                                exec('sudo python /usr/scripts/power.py $pin'); #runs python script
				echo "<h3>$computer has been reset</h3><p>"
        ?>
        
        <form>
                <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;">
    </form>
</form>
</body>
</html>
