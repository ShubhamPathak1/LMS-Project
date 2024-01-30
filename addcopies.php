<?php
    require '_dbconnect.php';
    $addCopiesSuccess = false;
    $addCopiesFail = false;
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $bookname = $_POST['bookList'];
        $addnoofcopies = $_POST['addnoofcopies'];
        if ($addnoofcopies!=0) {
            $searchBookQuery = "SELECT * from books where bookname='$bookname'";
            $searchBookResult = mysqli_query($conn, $searchBookQuery);
            if (mysqli_num_rows($searchBookResult) > 0) {
                $rowCopies = mysqli_fetch_assoc($searchBookResult);
                $presentCopies = $rowCopies['noofcopies'];
                $copiesToAdd = $presentCopies + $addnoofcopies; 
                $updateCopiesQuery = "UPDATE books set noofcopies=$copiesToAdd where bookname='$bookname'";
                $updateCopiesResult = mysqli_query($conn, $updateCopiesQuery);
                if ($updateCopiesQuery) {
                    $addCopiesSuccess = true;
                } else {
                    $addCopiesFail = "Some Error Occured. Try again.";
                }
            } else {
                $addCopiesFail = "No Books Found";
            }
        } else {
            $addCopiesFail = "Please Add Copies";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Copies - BookHub</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Add More Copies of a Book</h1>
            <div class="addformContain">

                <form action="addcopies.php" class="addForm" method="post">
                    <select name="bookList" id="bookList" class="selectItems dataEntryInput">
                        <option value="issueBookOptDefault" selected id="defaultBookSelect" class="selectOptions">Select Book</option>
                        <?php
                        $fetchBookQuery = "SELECT bookname from books";
                        $fetchBookResult = mysqli_query($conn, $fetchBookQuery);
                        if (mysqli_num_rows($fetchBookResult) > 0) {;
                            while ($row1 = mysqli_fetch_assoc($fetchBookResult)) {
                                echo '<option class="selectOptions" value="' . $row1['bookname'] . '">' . $row1['bookname'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="number" class="dataEntryInput" id="addnoofcopies" name="addnoofcopies" placeholder="Enter Number of Copies" min="0">

                    <input type="submit" value="Add Copies" id="addcopiesBtn" class="addBtn">
                </form>
            </div>
        </div>
    </div>
    <?php
        if ($addCopiesFail!=false) {
            echo '<script>
            let noOfCopiesInp = document.getElementById("addnoofcopies");
            let copiesAddError = document.createElement("p");
            copiesAddError.classList.add("entryErrorShow");
            copiesAddError.innerText = "' . $addCopiesFail . '";
            noOfCopiesInp.insertAdjacentElement("afterend", copiesAddError);
        </script>';
        }
        if ($addCopiesSuccess) {
            echo '<script>
            let noOfCopiesInp = document.getElementById("addnoofcopies");
            let copiesAddSuccess = document.createElement("p");
            copiesAddSuccess.classList.add("entrySuccessShow");
            copiesAddSuccess.innerText = "' . $addnoofcopies . ' Copies Added!";
            noOfCopiesInp.insertAdjacentElement("afterend", copiesAddSuccess);
        </script>';
        }
    ?>

</body>

</html>