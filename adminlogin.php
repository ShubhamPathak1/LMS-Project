<?php
    require '_dbconnect.php';
    $loginSuccess = false;
    $loginFail = false;
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];
        if ($username != "" && $pwd!="") {
            $checkRegUserSql = "SELECT * from admins where adminname='$username'";
            $checkRegUserResult = mysqli_query($conn, $checkRegUserSql);
            if (mysqli_num_rows($checkRegUserResult)==1) {
                while($rows = mysqli_fetch_assoc($checkRegUserResult)) {
                    if(password_verify($pwd, $rows['pwd'])) {
                        $loginSuccess = true;
                        session_start();
                        $_SESSION['adminLoggedIn'] = true;
                        $_SESSION['usernameAdmin'] = $username;
                        header("location: adminindex.php");
                        exit;
                    } else {
                        $loginFail = "Incorrect Password.";
                    }
                }
            } else {
                $loginFail = "You are not an Admin.";
            }
        } else {
            $loginFail = "Fields can't be empty.";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Hub - AdminLogin</title>
</head>

<body>
    <?php require 'links.php' ?>
    <div class="page userloginPage">
        <div class="webIntro">
            <h1 class="webTitle"><img class="titleImg" src="gallery/bookIcon.png" alt="">BookHub</h1>
            <h3 class="webSlogan1">Library Mastery, Simplified.</h3>
            <h4 class="webSlogan2"><span class="bookHubBig">BookHub</span> - Read. Manage. Thrive: Navigating the World of Books with Ease.</h4>
        </div>
        <div class="LoginContain formContain">
            <form action="adminlogin.php" method="post">
                <h1 class="formTitle">Admin Login to Book Hub</h1>
                <input type="text" name="username" id="username" class="inpBox usernameInput" placeholder="Username" maxlength="50">
                <input type="password" name="pwd" id="pwd" class="inpBox pwInput" placeholder="Password">
                <input type="submit" value="Log in" class="entryBtn">
                <p><a href="" class="formUnderline">Forgotten password?</a></p>
            </form>
            <p class="belowFormSmall">Not an Admin?<a href="userlogin.php" class="formUnderline">Login Here</a></p>
        </div>
    </div>
    <?php
    if ($loginFail != false) {
        echo '<script>
            let pwd = document.getElementById("pwd");
            let loginError = document.createElement("p");
            loginError.classList.add("entryErrorShow");
            loginError.innerText = "' . $loginFail . '";
            pwd.insertAdjacentElement("afterend", loginError);
        </script>';
    }
    ?>
</body>

</html>