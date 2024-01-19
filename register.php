<?php
require '_dbconnect.php';
$userexist = false;
$registerSuccess = false;
$registerFail = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['emailId'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cPwd'];
    if ($username != "" && $email != "" && $pwd != "" && $cpwd != "") {
        $checkExistingSql = "SELECT * from members where username='$username' or emailid='$email'";
        $checkExistingResult = mysqli_query($conn, $checkExistingSql);
        if (mysqli_num_rows($checkExistingResult) > 0) {
            $userexist = true;
            $rows = mysqli_fetch_assoc($checkExistingResult);
            if ($rows['username'] == $username) {
                $registerFail = "Username already taken.";
            }
            if ($rows['emailid'] == $email) {
                $registerFail = "Email already in use.";
            }
        } else {
            if ($pwd == $cpwd) {
                $hash = password_hash($cpwd, PASSWORD_DEFAULT);
                $registerUserSql = "INSERT INTO members(username, emailid, pwd) VALUES('$username', '$email', '$hash')";
                $registerUserResult = mysqli_query($conn, $registerUserSql);
                if ($registerUserResult) {
                    $registerSuccess = true;
                    header("location: userlogin.php");
                    exit();
                } else {
                    $registerFail = "Some error occured. Try again.";
                }
            } else {
                $registerFail = "Passwords don't match.";
            }
        }
    } else {
        $registerFail = "Fields can't be empty";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Register</title>
    
</head>

<body>
    <?php require 'links.php' ?>
    <div class="page signupPage">
        <div class="webIntro">
            <h1 class="webTitle"><img src="gallery/bookIcon.png" alt="" class="titleImg">BookHub</h1>
            <h3 class="webSlogan1">Library Mastery, Simplified.</h3>
            <h4 class="webSlogan2"><span class="bookHubBig">BookHub</span> - Read. Manage. Thrive: Navigating the World of Books with Ease.</h4>
        </div>
        <div class="RegisterContain formContain">
            <form action="register.php" method="post">
                <h1 class="formTitle">Register to Book Hub</h1>
                <input type="text" name="username" id="username" class="inpBox usernameInput" placeholder="Username" maxlength="50">
                <input type="email" name="emailId" id="emailId" class="inpBox emailInput" placeholder="Email Address">
                <input type="password" name="pwd" id="pwd" class="inpBox pwInut" placeholder="Create Password">
                <input type="password" name="cPwd" id="cPwd" class="inpBox cpwInput" placeholder="Confirm Password">
                <input type="submit" value="Register" class="entryBtn">
                <p class="">Have an account? <a href="userlogin.php" class="formUnderline">Login</a></p>
            </form>
        </div>
    </div>
    <?php
    if ($registerFail != false) {
        echo '<script>
            let cwpd = document.getElementById("cPwd");
            let registerError = document.createElement("p");
            registerError.classList.add("entryErrorShow");
            registerError.innerText = "' . $registerFail . '";
            cwpd.insertAdjacentElement("afterend", registerError);
        </script>';
    }
    ?>
</body>

</html>