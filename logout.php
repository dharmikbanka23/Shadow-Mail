<?php
// Expire the cookie
setcookie("name", "", time() - 0, "/");

// Start the session
session_start();

// Remove all session variables
session_unset();

// Redirect back to index.php 
header("Location: index.php");