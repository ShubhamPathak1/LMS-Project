<?php

require '_dbconnect.php';
$bookAddSuccess = false;
$bookAddFail = false;

function NeworExisting($conn, $ListOpt, $catAuthPubName, $tablename, $inputname, $inputid) {
    if ($ListOpt == "addnew") {
        $catAuthPubName = $_POST[$inputname];
        $addFail = false;
        if ($catAuthPubName != "") {
            $searchQuery = "SELECT * FROM $tablename WHERE $inputname='$catAuthPubName'";
            $searchResult = mysqli_query($conn, $searchQuery);
            if (mysqli_num_rows($searchResult) > 0) {
                $addFail = "$tablename Already Exists.";
            } else {
                $addQuery = "INSERT INTO $tablename($inputname) VALUES('$catAuthPubName')";
                $addResult = mysqli_query($conn, $addQuery);
                if (!$addResult) {
                    $addFail = "Some Error Occured.";
                }
            }
        }
        $getSql = "SELECT $inputid FROM $tablename WHERE $inputname='$catAuthPubName'";
        $getId = mysqli_query($conn, $getSql);
        if (mysqli_num_rows($getId) == 1) {
            $rowId = mysqli_fetch_assoc($getId);
            $neededId = $rowId[$inputid];
        }
        return [$neededId, $catAuthPubName, $addFail];
    } else {
        $getSql = "SELECT $inputid FROM $tablename WHERE $inputname='$ListOpt'";
        $getId = mysqli_query($conn, $getSql);
        if (mysqli_num_rows($getId) == 1) {
            $rowId = mysqli_fetch_assoc($getId);
            $neededId = $rowId[$inputid];
            return [$neededId, $ListOpt, false];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bookname = $_POST['bookname'];
    $noofcopies = $_POST['noofcopies'];

    $authorListOpt = $_POST['authorsList'];
    $categoryListOpt = $_POST['categoriesList'];
    $publicationListOpt = $_POST['publicationsList'];
    $authorname = 0;
    $categoryname = 0;
    $publicationname = 0;

    list($authorid, $authorname, $authorAddFail) = NeworExisting($conn, $authorListOpt, $authorname, 'author', 'authorname', 'authorid');
    list($catid, $categoryname, $categoryAddFail) = NeworExisting($conn, $categoryListOpt, $categoryname, 'category', 'categoryname', 'catid');
    list($pubid, $publicationname, $publicationAddFail) = NeworExisting($conn, $publicationListOpt, $publicationname, 'publication', 'publicationname', 'pubid');
    $rawbookNumber = $_POST['booknumber'];
    $booknumber = $_POST['booknumber'] . "" . substr($authorname, 0, 3) . "" . substr($categoryname, 0, 3) . "" . substr($publicationname, 0, 3);

    if ($bookname != "" && $booknumber != "" && $publicationname != "" && $authorname != "" && $categoryname != "" && $noofcopies != "") {
        $searchbooknoQuery = "SELECT * FROM books WHERE booknumber=$rawbookNumber";
        $searchbooknoResult = mysqli_query($conn, $searchbooknoQuery);
        $searchbookQuery = "SELECT * FROM books WHERE bookname='$bookname'";
        $searchbookResult = mysqli_query($conn, $searchbookQuery);
        if (mysqli_num_rows($searchbookResult) > 0) {
            $bookAddFail = "Book Already Exists.";
        } elseif (mysqli_num_rows($searchbooknoResult) > 0) {
            $bookAddFail = "Book Number Already Used.";
        } else {
            $addbookQuery = "INSERT INTO books(bookname, booknumber, catid, authorid, pubid, noofcopies) VALUES('$bookname', '$booknumber', '$catid', '$authorid', '$pubid', $noofcopies)";
            $addbookResult = mysqli_query($conn, $addbookQuery);
            if ($addbookResult) {
                $bookAddSuccess = true;
            } else {
                $bookAddFail = "Some Error Occured. Try again.";
            }
        }
    } else {
        $bookAddFail = "Field is blank.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Entry - BookHub </title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Book Entry</h1>
            <div class="addformContain">

                <form action="entrybook.php" class="addForm" method="post">
                    <input type="text" class="dataEntryInput" id="bookname" name="bookname" placeholder="Enter Book Name">
                    <select name="categoriesList" id="categoriesList" class="selectItems dataEntryInput">
                        <option value="addCatOptDefault" selected id="defaultCatSelect" class="selectOptions">Add Category</option>
                        <?php
                    $fetchCatQuery = "SELECT categoryname from category";
                    $fetchCatResult = mysqli_query($conn, $fetchCatQuery);
                    if (mysqli_num_rows($fetchCatResult) > 0) {;
                        while ($row1 = mysqli_fetch_assoc($fetchCatResult)) {
                            echo '<option class="selectOptions" value="' . $row1['categoryname'] . '">' . $row1['categoryname'] . '</option>';
                        }
                    }
                    ?>
                    <option value="addnew" id="addnewCat" class="selectOptions">Add New</option>
                </select>
                <input type="text" class="dataEntryInput" id="categoryname" name="categoryname" placeholder="Enter Category Name" hidden>
                <select name="authorsList" id="authorsList" class="selectItems dataEntryInput">
                    <option value="addAuthorOptDefault" selected id="defaultAuthorSelect" class="selectOptions">Add Author</option>
                    <?php
                    $fetchAuthorQuery = "SELECT authorname from author";
                    $fetchAuthorResult = mysqli_query($conn, $fetchAuthorQuery);
                    if (mysqli_num_rows($fetchAuthorResult) > 0) {;
                        while ($row2 = mysqli_fetch_assoc($fetchAuthorResult)) {
                            echo '<option class="selectOptions" value="' . $row2['authorname'] . '">' . $row2['authorname'] . '</option>';
                        }
                    }
                    ?>
                    <option value="addnew" id="addnewAuthor" class="selectOptions">Add New</option>
                </select>
                <input type="text" class="dataEntryInput" id="authorname" name="authorname" placeholder="Enter Author Name" hidden>
                <select name="publicationsList" id="publicationsList" class="selectItems dataEntryInput">
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
                    <option value="addnew" id="addnewPublication" class="selectOptions">Add New</option>
                </select>
                <input type="text" class="dataEntryInput" id="publicationname" name="publicationname" placeholder="Enter Publication Name" hidden>
                <input type="number" class="dataEntryInput" id="booknumber" name="booknumber" placeholder="Enter Book Number" max="1000" min="0">
                <input type="number" class="dataEntryInput" id="noofcopies" name="noofcopies" placeholder="Enter Number of Copies" min="0">

                <input type="submit" value="Enter Book" id="addbookBtn" class="addBtn">
            </form>
        </div>
        </div>
    </div>

    <script>
        Array.from(document.getElementsByClassName("selectItems")).forEach(element => {
            element.addEventListener("change", function(){
                let selectedValue = this.value 
                if (selectedValue=="addnew") {
                element.style.display = "none"
                element.nextElementSibling.hidden = false
                }
            })
        });
    </script>
    <?php
        if ($bookAddFail!=false) {
            echo '<script>
            let noOfCopiesInp = document.getElementById("noofcopies");
            let bookAddError = document.createElement("p");
            bookAddError.classList.add("entryErrorShow");
            bookAddError.innerText = "' . $bookAddFail . '";
            noOfCopiesInp.insertAdjacentElement("afterend", bookAddError);
        </script>';
        }
        if ($bookAddSuccess) {
            echo '<script>
            let noOfCopiesInp = document.getElementById("noofcopies");
            let bookAddSuccess = document.createElement("p");
            bookAddSuccess.classList.add("entrySuccessShow");
            bookAddSuccess.innerText = "Book Added!";
            noOfCopiesInp.insertAdjacentElement("afterend", bookAddSuccess);
        </script>';
        }

    ?>
</body>

</html>