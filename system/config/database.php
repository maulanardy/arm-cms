<?php
	$config['dbuser'] = "root";
 	$config['dbpassword'] = "";
 	$config['dbname'] = "armcms";
 	$config['dbhost'] = "localhost";


  	$con = mysqli_connect ($config['dbhost'], $config['dbuser'], $config['dbpassword']);
	if (mysqli_connect_errno())
  		{
  			echo"Connection failed.";
  		}
	else {echo "";}
 	mysqli_select_db ($con, $config['dbname']);
	
	date_default_timezone_set("Asia/Jakarta");

?>
