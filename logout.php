<?php
session_start();

// Check and unset resident_id session variable if set
if (isset($_SESSION['resident_id'])) {
    unset($_SESSION['resident_id']);
}

// Check and unset staff_id session variable if set
if (isset($_SESSION['staff_id'])) {
    unset($_SESSION['staff_id']);
}

// Redirect to the login page
session_destroy();
header("Location: ./loginResponsive.php");
exit();
?>