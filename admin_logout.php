<?php
// Prevent the page from being cached
header("Cache-Control: no-cache, no-store, must-revalidate");  // HTTP/1.1
header("Pragma: no-cache");  // HTTP/1.0
header("Expires: 0");  // Proxies

// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page (admin_login.html)
header("Location: admin_login.html");
exit();  // Ensure the script stops executing after the redirect
?>
