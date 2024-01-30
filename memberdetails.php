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
                        $emailid = $rows['emailid'];
                        $regdate = $rows['regdate'];
                        $creditpoint = $rows['creditpoint'];
                        echo '
                            <div class="displayBox">
                            <div class="detailsImgBox"><img src="" alt="Profile Pic"></div>
                            <h3 class="detailsNameTitle">' . $username . '</h3>
                            <div class="afterNamemainDetails">
                            <p class="">User Id: <span class="detailsText "> ' . $uid . '</span></p>
                            <p class="">Email Id: <span class="detailsText largeDetailsText"> ' . $emailid . '</span></p>
                            <p class="">Registered Date: <span class="detailsText largeDetailsText"> ' . $regdate . '</span></p>
                            <p class="">Credit Points: <span class="detailsText largeDetailsText"> ' . $creditpoint . '</span></p>
                            </div>
                            </div>';
                    }
                }


                ?>
            </div>
        </div>
    </div>
</body>

</html>