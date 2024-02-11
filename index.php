<?php
session_start();

if (isset($_SESSION['adminLoggedIn'])) {
    // If an admin is logged in, redirect to adminindex.php
    header("Location: adminindex.php");
    exit();
} elseif (isset($_SESSION['memberLoggedIn'])) {
    // If a user is logged in, redirect to userindex.php
    header("Location: userindex.php");
    exit();
} else {
    // If not logged in, redirect to userlogin.php
    header("Location: userlogin.php");
    exit();
}
?>
