<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: http://localhost/chxbbyx/GYMX%20admin/index.php");
exit; // Ensure script execution stops here
?>
