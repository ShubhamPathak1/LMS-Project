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
            <h1 class="pageTitle">Book Details</h1>
            <div class="filterSortBox">
                <input type="text" name="searchBookname" id="searchBookname" class="dataEntryInput searchBar" placeholder="Search Book">
            <select name="categoriesList" id="categoriesList" class="selectItems dataEntryInput filterDrop">
                        <option value="addCatOptDefault" selected id="defaultCatSelect" class="selectOptions">Category</option>
                        <?php
                    $fetchCatQuery = "SELECT categoryname from category";
                    $fetchCatResult = mysqli_query($conn, $fetchCatQuery);
                    if (mysqli_num_rows($fetchCatResult) > 0) {;
                        while ($row1 = mysqli_fetch_assoc($fetchCatResult)) {
                            echo '<option class="selectOptions" value="' . $row1['categoryname'] . '">' . $row1['categoryname'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <select name="publicationsList" id="publicationsList" class="selectItems dataEntryInput filterDrop">
                    <option value="addPublicationOptDefault" selected id="defaultPublicationSelect" class="selectOptions">Add Publication</option>
                    <?php
                    $fetchPublicationQuery = "SELECT publicationname from publication";
                    $fetchPublicationResult = mysqli_query($conn, $fetchPublicationQuery);
                    if (mysqli_num_rows($fetchPublicationResult) > 0) {;
                        while ($row3 = mysqli_fetch_assoc($fetchPublicationResult)) {
                            echo '<option class="selectOptions" value="' . $row3['publicationname'] . '">' . $row3['publicationname'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <select name="authorsList" id="authorsList" class="selectItems dataEntryInput filterDrop">
                    <option value="addAuthorOptDefault" selected id="defaultAuthorSelect" class="selectOptions">Author</option>
                    <?php
                    $fetchAuthorQuery = "SELECT authorname from author";
                    $fetchAuthorResult = mysqli_query($conn, $fetchAuthorQuery);
                    if (mysqli_num_rows($fetchAuthorResult) > 0) {;
                        while ($row2 = mysqli_fetch_assoc($fetchAuthorResult)) {
                            echo '<option class="selectOptions" value="' . $row2['authorname'] . '">' . $row2['authorname'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="displayPage">
            <?php
                    $bookFetchSql = "SELECT books.bookid, books.bookname, books.booknumber, books.catid, category.categoryname, books.pubid, publication.publicationname, books.authorid, author.authorname, books.noofcopies, books.copiesavailable from books join category on books.catid=category.catid join publication on books.pubid=publication.pubid join author on books.authorid=author.authorid order by books.bookid";
                    $bookFetchResult = mysqli_query($conn, $bookFetchSql);
                    if (mysqli_num_rows($bookFetchResult) > 0) {
                        while ($rows = mysqli_fetch_assoc($bookFetchResult)) {
                            $bookid = $rows['bookid'];
                            $bookname = strtoupper($rows['bookname']);
                            $booknumber = $rows['booknumber'];
                            $catid = $rows['catid'];
                            $categoryname = ucfirst($rows['categoryname']);
                            $pubid = $rows['pubid'];
                            $publicationname = ucfirst($rows['publicationname']);
                            $authorid = $rows['authorid'];
                            $authorname = ucfirst($rows['authorname']);
                            $noofcopies = $rows['noofcopies'];
                            $copiesavailable = $rows['copiesavailable'];
                            // echo '
                            // <div class="displayBox">
                            // <div class="detailsTextBox">
                            // <h3 class="detailsNameTitle">' . $bookname . '</h3>
                            // <div class="afterNamemainDetails">
                            // <p class="">Book Number: <span class="detailsText "> ' . $booknumber . '</span></p>
                            // <p class="">Category: <span class="detailsText largeDetailsText"> ' . $categoryname . '</span></p>
                            // <p class="">Publication: <span class="detailsText largeDetailsText"> ' . $publicationname . '</span></p>
                            // <p class="">Author: <span class="detailsText largeDetailsText"> ' . $authorname . '</span></p>
                            // <p class="">Total Copies: <span class="detailsText"> ' . $noofcopies . '</span></p>
                            // <p class="">Copies Available: <span class="detailsText largeDetailsText"> ' . $copiesavailable . '</span></p>
                            // </div>
                            // </div>
                            // <div class="detailsImgBox"><img src="" alt="Book Image"></div>
                            // </div>';
                            echo '
                            
                            <div class="displayBox">
                            <div class="detailsImgBox"><img src="" alt="Book Image"></div>
                            <h3 class="detailsNameTitle">' . $bookname . '</h3>
                            <div class="afterNamemainDetails">
                            <p class="">Book Number: <span class="detailsText "> ' . $booknumber . '</span></p>
                            <p class="">Category: <span class="detailsText largeDetailsText"> ' . $categoryname . '</span></p>
                            <p class="">Publication: <span class="detailsText largeDetailsText"> ' . $publicationname . '</span></p>
                            <p class="">Author: <span class="detailsText largeDetailsText"> ' . $authorname . '</span></p>
                            <p class="">Total Copies: <span class="detailsText"> ' . $noofcopies . '</span></p>
                            <p class="">Copies Available: <span class="detailsText largeDetailsText"> ' . $copiesavailable . '</span></p>
                            </div>
                            </div>
                            ';
                        }
                    }
                    
                    
                    ?>
            
            </div>
        </div>
    </div>
</body>

</html>