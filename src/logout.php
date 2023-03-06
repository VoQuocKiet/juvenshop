<?php
session_start();
ob_start();
unset ($_SESSION['user_name']);
header('location: homepage.php');
?>