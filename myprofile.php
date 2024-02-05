<?php require '_dbconnect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Books - BookHub</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <?php require_once 'usernav.php' ?>
    <div class="userotherPage">
        <h1 class="pageTitle">My Profile</h1>
        <div class="displayProfile">
            <?php
            $getUsername = $_SESSION['usernameMember'];
            $myprofileFetchSql = "SELECT username, emailid, regdate, creditpoint from members where username = '$getUsername'";
            $myprofileFetchResult = mysqli_query($conn, $myprofileFetchSql);
            if (mysqli_num_rows($myprofileFetchResult) > 0) {
                $rows = mysqli_fetch_assoc($myprofileFetchResult);
                $username = $rows['username'];
                $emailid = $rows['emailid'];
                $regdate = $rows['regdate'];
                $creditpoint = $rows['creditpoint'];
                echo '<p class="detailP">Username: <span class="largeDetailsText"> ' . $username . '</span></p>
                <p class="detailP">Email Id: <span class="largeDetailsText"> ' . $emailid . '</span></p>
                <p class="detailP">Registered Date: <span class="largeDetailsText"> ' . $regdate . '</span></p>
                <p class="detailP">Credit Points: <span class="largeDetailsText"> ' . $creditpoint . '</span></p>';
            }
            ?>
                    
        </div>
    </div>
</body>

</html>