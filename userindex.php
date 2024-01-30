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
    <title>Document</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <?php require_once 'usernav.php' ?>
    <div class="usermainPage">
        <div class="aboutlibrary insideUserPage">
            <h4 class=""><span class="bookHubBig">BookHub</span> - Read. Manage. Thrive: Navigating the World of Books with Ease.</h4>

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
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci eaque cumque cum! Beatae quia cum voluptates eligendi, praesentium nemo, vel ratione architecto sed ipsa quos cupiditate sequi ipsum dolorem dignissimos, veritatis soluta pariatur consequuntur. Optio cum voluptatibus non magni culpa laboriosam fuga, delectus odio iusto illum quos totam ea odit ducimus ullam modi minima dicta? Sed nam labore expedita harum natus vero cum fugit illo incidunt obcaecati quas distinctio ad, reprehenderit voluptatem saepe quidem inventore magni similique dicta facere hic. Accusantium quas atque, odit ea dolorem pariatur. Exercitationem labore amet molestias, corrupti similique doloremque asperiores voluptatibus corporis necessitatibus dolor. Perspiciatis itaque nam sapiente deleniti minima et voluptas culpa voluptatibus, voluptates ut ad unde dolores? Consequatur nulla corporis error minima voluptates nemo esse qui vel perferendis impedit necessitatibus omnis recusandae veritatis eum tempora repudiandae, minus quasi vitae delectus distinctio nihil totam in eos laboriosam? In consequatur reiciendis eligendi quia asperiores error ex illo odio quae provident, voluptatum pariatur qui nemo, eveniet sed quo vel assumenda illum. Eos itaque eaque obcaecati labore unde reiciendis voluptate nesciunt, animi non ullam ab corrupti repellendus eum inventore odit delectus quod et, assumenda, illum beatae. Maiores fuga molestiae illum et eaque eius deleniti similique ipsum minima! Recusandae quo alias, odit repudiandae laudantium ipsa eveniet aliquid, repellendus beatae nulla ad nam illo, explicabo unde ducimus libero quam porro provident eligendi? Placeat cum recusandae, suscipit itaque nulla illo omnis laboriosam non doloremque velit nemo harum! Placeat illo voluptate non, sint consequuntur at perferendis eius exercitationem modi vel harum! Similique atque sequi unde voluptates ea. Corrupti aperiam adipisci id! Porro quae reiciendis expedita est, labore cumque commodi velit cupiditate laborum ad modi explicabo ab fugit nisi eius quis blanditiis dicta quisquam rem et fuga voluptates temporibus! Molestiae cupiditate, officia quis dolorem facilis, dolorum commodi quam magni ipsam cum aliquid laborum, minus maxime ratione id doloremque nemo odio minima explicabo incidunt libero alias in eius. Magnam quisquam labore asperiores esse, tempora laborum, iure minus in, dignissimos tempore incidunt. Architecto facere nostrum dignissimos similique, ab fuga! Numquam hic eius aut non. Nobis voluptates voluptas architecto sed dolore dolorem vero iste iure commodi sint obcaecati dolorum necessitatibus quia totam maxime distinctio autem aliquid sit, quas quo quisquam ratione enim! Recusandae tempora suscipit reprehenderit quam nemo dolores praesentium mollitia tempore vitae accusamus neque expedita adipisci eaque, eos quod harum facere odit veniam eius itaque nostrum blanditiis! Quidem quod, iste, perferendis laborum ab tempora delectus maiores odit quis odio perspiciatis libero optio nihil accusantium earum placeat! Repellendus fuga odit iusto, reiciendis sequi minima id ipsa ratione, qui nobis, totam animi error impedit dolorum voluptas eligendi officia doloribus distinctio ab iste perferendis accusantium. Natus ab consequuntur, reiciendis eaque, obcaecati libero ratione quod ipsa adipisci quae dolorem excepturi fugiat ex totam architecto, enim alias voluptates impedit commodi explicabo? Provident aliquid, dolore quas maxime nihil tempora necessitatibus amet enim sed aut quis eius. Similique aperiam rerum earum alias officia! Atque velit culpa sequi ducimus magni provident esse quasi commodi eveniet natus rerum quibusdam, sunt inventore deleniti itaque. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam atque nobis aliquid magni reprehenderit exercitationem nihil, molestiae repellendus nemo iusto eaque facere? Libero iusto pariatur consequuntur ex? Aut aliquid ipsam debitis placeat quas porro facilis incidunt veniam sunt assumenda, adipisci vitae, temporibus itaque consectetur velit aliquam nihil numquam, architecto nobis tenetur fuga sapiente quaerat eum quisquam! Impedit incidunt, nulla ad molestias aliquid fugit consequuntur adipisci dolorum dolores cupiditate minus possimus id quisquam quis officiis commodi consectetur neque! Eum corrupti dolores nulla maxime? Eveniet, voluptate. Incidunt alias quam assumenda placeat? Quasi obcaecati incidunt fugiat, nam sint voluptas enim vero a odit ullam magnam, voluptates, blanditiis ea praesentium! Rerum id molestiae temporibus sequi incidunt quos sapiente atque, perspiciatis eos accusantium doloribus libero labore iste vel ut aliquam? Harum eligendi magnam minus optio fugit recusandae eveniet! Adipisci inventore excepturi blanditiis animi sequi reprehenderit provident tempora magnam officiis quis quo voluptatibus error odio rerum nobis natus, molestias consequuntur qui esse architecto unde? Cupiditate numquam, perferendis dignissimos delectus blanditiis neque voluptatibus sed nobis unde adipisci exercitationem, ipsum velit facere. Cumque inventore non rerum ipsum aut distinctio blanditiis repellat ut ab iste voluptatum, placeat quidem expedita a obcaecati consequuntur dolores aspernatur facilis mollitia quam tempore ratione. Qui, impedit. Facere aspernatur tempora sint perspiciatis necessitatibus repellendus a, maiores fugiat nesciunt distinctio eos ea debitis neque placeat numquam rem laborum obcaecati saepe fuga exercitationem at ad? Repellendus alias, aspernatur error, nemo reprehenderit ducimus voluptate maiores omnis, aut laboriosam possimus! Ipsum distinctio repellendus delectus? Esse consequuntur cum voluptatem reprehenderit adipisci corrupti repellat vel cupiditate fugit placeat, dicta velit ea nihil! Aliquid, mollitia tenetur quas fuga itaque dolorum architecto assumenda debitis quia sapiente quasi facilis quae modi ducimus exercitationem ratione! Dolorem porro quo ab atque. Assumenda, eius? Impedit sequi nulla laboriosam a suscipit aliquid optio reprehenderit inventore, perferendis dicta hic.
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