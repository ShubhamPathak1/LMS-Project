<?php
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
    <title>Document</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <?php require_once 'usernav.php' ?>
    <div class="usermainPage">
        <div class="aboutlibrary insideUserPage">
            <h4 class="webSlogan2"><span class="bookHubBig">BookHub</span> - Read. Manage. Thrive: Navigating the World of Books with Ease.</h4>

            <section id="rules">
                <h3>Rules</h3>
                <ul>
                    <li>Respect others' reading space.</li>
                    <li>Return borrowed books on time.</li>
                    <li>Keep the library quiet and conducive to reading.</li>
                    <li>No food or drinks in the library.</li>
                    <li>Follow the library's code of conduct.</li>
                </ul>
            </section>

            <section id="timings">
                <h3>Library Timings</h3>
                <p>Monday to Friday: 9:00 AM - 6:00 PM</p>
                <p>Saturday: 10:00 AM - 4:00 PM</p>
                <p>Sunday: Closed</p>
            </section>
        </div>
        <div class="aboutuser insideUserPage">
            <h1>Hi <?php echo strtoupper($_SESSION['usernameMember']) ?></h1>
            <div class="myCreditPoint insideAboutUser">
                <!-- Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis cupiditate hic impedit asperiores necessitatibus. Ipsum fuga eligendi modi consequuntur quis asperiores adipisci veritatis exercitationem corrupti! -->
            </div>
            <div class="myBooks insideAboutUser">
                <!-- Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque, architecto dolorem molestiae quisquam ratione porro neque autem consectetur itaque sequi praesentium nisi. Unde voluptatem, quo, adipisci officia qui vel molestiae quia odio minima velit fugiat. Deserunt quia reprehenderit, at beatae et porro aperiam ut, necessitatibus vel exercitationem adipisci tempora ab amet, cum laboriosam hic nam soluta earum eum natus odio tenetur. Tempore dolor doloribus animi quo molestias quibusdam rem perspiciatis eligendi. Nostrum fugit quisquam, laborum quam facilis sequi sunt culpa, ut deserunt reprehenderit dolorum quis labore voluptatem id sit eius accusantium vero accusamus repudiandae explicabo minus? Praesentium aliquam quasi tempora. -->
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>