<?php
session_start();
include('config.php');

// Retrieve and sanitize form data
$slot_id = $_POST['slot_id'];

// Use prepared statements to prevent SQL injection
$sql = "DELETE FROM slots WHERE slot_id = '$slot_id'";

if(mysqli_query($connection, $sql)){
    echo '<script language="javascript">';
    echo 'alert("User deleted successfully!");';
    echo 'window.location="csadmin_database-slots.php";';
    echo '</script>';   
} else {
    echo '<script language="javascript">';
    echo 'alert("Error Deleting!");';
    echo 'window.location="csadmin_database-slots.php";';
    echo '</script>';
}
?>
