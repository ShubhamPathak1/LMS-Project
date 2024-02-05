<?php
require '_dbconnect.php';
session_start();
if (!isset($_SESSION['memberLoggedIn']) || $_SESSION['memberLoggedIn'] != true) {
    header("location: userlogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <?php require_once 'usernav.php' ?>
    <div class="usermainPage">
        <div class="aboutlibrary insideUserPage">
            <h4 class="webSlogan2"><span class="bookHubBig">BookHub</span> - Read. Manage. Thrive: Navigating the World of Books with Ease.</h4>

            <section id="rules">
                <h3 class="webSlogan2">Rules</h3>
                <ul>
                    <li class="normalUindexText">Respect others' reading space.</li>
                    <li class="normalUindexText">Return borrowed books on time.</li>
                    <li class="normalUindexText">Keep the library quiet and conducive to reading.</li>
                    <li class="normalUindexText">No food or drinks in the library.</li>
                    <li class="normalUindexText">Follow the library's code of conduct.</li>
                </ul>
            </section>

            <section id="timings">
                <h3 class="webSlogan2">Library Timings</h3>
                <ul>
                    <li class="normalUindexText">Monday to Friday: 9:00 AM - 6:00 PM</li>
                    <li class="normalUindexText">Saturday: 10:00 AM - 4:00 PM</li>
                    <li class="normalUindexText">Sunday: Closed</li>
                </ul>
            </section>
        </div>
        <div class="aboutuser insideUserPage">
            <h1 class="aboutuserTitle">Hi <?php echo strtoupper($_SESSION['usernameMember']) ?></h1>
            <div class="myCreditPoint insideAboutUser">
                <h2 class="aboutuserTitle">My Credit Points</h2>
                <?php 
                $username = $_SESSION['usernameMember'];
                $getCPQuery = "SELECT creditpoint from members where username='$username'";
                $getCPResult = mysqli_query($conn, $getCPQuery);
                if (mysqli_num_rows($getCPResult)>0) {
                    $rowsCP = mysqli_fetch_assoc($getCPResult);
                    $CP = $rowsCP['creditpoint'];
                    echo "<p class='aboutUserInfos'>$CP</p>";
                } else {
                    echo "<p class='insidemyCP'>Not Found</p>";
                }
                ?>
            </div>
            <div class="myBooks insideAboutUser">
                <h2 class="aboutuserTitle">My Books</h2>
                <?php 
                    $getMyBooksQuery = "SELECT books.bookname, bookissued.toreturndate from bookissued join books on bookissued.bookid=books.bookid join members on bookissued.uid=members.uid where members.username='$username'";
                    $getMyBooksResult = mysqli_query($conn, $getMyBooksQuery);
                    if (mysqli_num_rows($getMyBooksResult)>0) {
                        while($rows = mysqli_fetch_assoc($getMyBooksResult)) {
                            $bookname = strtoupper($rows['bookname']);
                            $toreturndate = $rows['toreturndate'];
                            echo "<p class='aboutUserInfos'>$bookname</p>";
                            echo "<p class=''>Return By: $toreturndate</p>";
                        }
                    } else {
                        echo "You haven't borrowed any books.";
                    }
                 ?>
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>