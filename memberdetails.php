<?php require '_dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - BookHub</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Member Details</h1>
            <div class="displayPage">
                <?php
                // $bookFetchSql = "SELECT books.bookid, books.bookname, books.booknumber, books.catid, category.categoryname, books.pubid, publication.publicationname, books.authorid, author.authorname, books.noofcopies, books.copiesavailable from books join category on books.catid=category.catid join publication on books.pubid=publication.pubid join author on books.authorid=author.authorid order by books.bookid";
                // $bookFetchResult = mysqli_query($conn, $bookFetchSql);
                $memberFetchSql = "SELECT uid, username, emailid, regdate, creditpoint from members order by uid";
                $memberFetchResult = mysqli_query($conn, $memberFetchSql);
                if (mysqli_num_rows($memberFetchResult) > 0) {
                    while ($rows = mysqli_fetch_assoc($memberFetchResult)) {
                        $uid = $rows['uid'];
                        $username = strtoupper($rows['username']);
                        $usernameBook = $rows['username'];
                        $emailid = $rows['emailid'];
                        $regdate = $rows['regdate'];
                        $creditpoint = $rows['creditpoint'];
                        
                        // <div class="detailsImgBox"><img src="" alt="Profile Pic"></div>
                        
                        echo '<div class="displayBox">'; 
                        echo '
                            <h3 class="detailsNameTitle">' . $username . '</h3>
                            <div class="afterNamemainDetails">
                            <p class="detailP">User Id: <span class="detailsText "> ' . $uid . '</span></p>
                            <p class="detailP">Email Id: <span class="detailsText largeDetailsText"> ' . $emailid . '</span></p>
                            <p class="detailP">Registered Date: <span class="detailsText largeDetailsText"> ' . $regdate . '</span></p>
                            <p class="detailP">Credit Points: <span class="detailsText largeDetailsText"> ' . $creditpoint . '</span></p>';
                            echo '<br>';
                            echo '<p class="largeDetailsText">BOOKS BORROWED:</p>';

                            $getMyBooksQuery = "SELECT books.bookname from bookissued join books on bookissued.bookid=books.bookid join members on bookissued.uid=members.uid where members.username='$usernameBook'";
                            $getMyBooksResult = mysqli_query($conn, $getMyBooksQuery);
                            if (mysqli_num_rows($getMyBooksResult)>0) {
                                while($rows = mysqli_fetch_assoc($getMyBooksResult)) {
                                    $bookname = $rows['bookname'];
                                    // $toreturndate = $rows['toreturndate'];
                                    echo "<p class='detailP'>$bookname</p>";
                                    // echo "<p class=''>Return By: $toreturndate</p>";
                                }
                            } else {
                                echo '<p class="detailP">No Books Borrowed.</p>';
                            }
                            
                            echo '</div>';
                            echo '</div>';
                        
                    }
                }


                ?>
            </div>
        </div>
    </div>
</body>

</html>