<?php require '_dbconnect.php';
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
    <!-- <div class="usermainPage">
        <div class="aboutlibrary insideUserPage">
            <h1 class="pageTitle">Find Books</h1>
        </div>
    </div> -->
    <div class="userotherPage">
        <h1 class="pageTitle">My Profile</h1>
        <div class="addformContain">
            <form action="myprofile.php" class="addForm" method="post">
                <label for="username">Username: </label><input type="text" name="username" id="username" readonly class="dataEntryInput" placeholder="Issue Date" value="My username">
                
                <input type="text" name="toreturndate" id="toreturndate" readonly class="dataEntryInput" placeholder="Return Deadline">
            </form>
        </div>
    </div>
</body>

</html>