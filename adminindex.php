<?php
session_start();
if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: userlogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard  - BookHub </title>
    <?php  require_once 'links.php' ?>
</head>
<body>
    <div class="pageFlex">
        <?php  require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Admin Dashboard</h1>
        </div>
    </div>
</body>
</html>