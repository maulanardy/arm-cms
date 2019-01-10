<?php
		
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_password']);
unset($_SESSION['user_fullname']);
unset($_SESSION['user_email']);
unset($_SESSION['user_group']);
unset($_SESSION['LastLogin']);
unset($_SESSION['flag']);
session_destroy();

header("Location: ".BASE);

// echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

?>