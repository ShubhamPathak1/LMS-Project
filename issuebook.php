<?php
require '_dbconnect.php';
$bookIssueSuccess = false;
$bookIssueFail = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['userList'];
    $bookname = $_POST['bookList'];
    $issuedate = $_POST['issuedate'];
    $toreturndate = $_POST['toreturndate'];
    
    if ($bookname!="issueBookOptDefault" && $username!="issueUserOptDefault") {
        $getbookidSql = "SELECT  bookid, catid, authorid, pubid from books where bookname='$bookname'";
        $getbookid = mysqli_query($conn, $getbookidSql);
        if (mysqli_num_rows($getbookid) == 1) {
            $rowbookid = mysqli_fetch_assoc($getbookid);
            $bookid = $rowbookid['bookid'];
            $catid = $rowbookid['catid'];
            $authorid = $rowbookid['authorid'];
            $pubid = $rowbookid['pubid'];
        }
    
        $getuseridSql = "SELECT uid from members where username='$username'";
        $getuserid = mysqli_query($conn, $getuseridSql);
        if (mysqli_num_rows($getuserid) == 1) {
            $rowuserid = mysqli_fetch_assoc($getuserid);
            $uid = $rowuserid['uid'];
        }

        $check1Sql = "SELECT uid from bookissued where bookid=$bookid and uid=$uid";
        $check1SqlResult = mysqli_query($conn, $check1Sql);
        $check2Sql = "SELECT count(distinct issueid) as limitCount from bookissued where uid=$uid";
        $check2SqlResult = mysqli_query($conn, $check2Sql);
        if ($check2SqlResult) {
            $rowLimits = mysqli_fetch_assoc($check2SqlResult);
            $bookLimitReach = $rowLimits['limitCount'];
        }
        if (mysqli_num_rows($check1SqlResult)==1) {
            $bookIssueFail = "User already has this book.";
        }
        elseif ($bookLimitReach==3) {
            $bookIssueFail = "User already has 3 books and can't borrow more.";
        }
        else {
            $issueBookQuery = "INSERT INTO bookissued(bookid, uid, catid, authorid, pubid, issuedate, toreturndate) VALUES ('$bookid', '$uid', '$catid', '$authorid', '$pubid', '$issuedate', '$toreturndate')";
            $issueBookResult = mysqli_query($conn, $issueBookQuery);
            if ($issueBookQuery) {
                $updateReserveSql = "UPDATE books set copiesavailable=copiesavailable-1 where bookname='$bookname'";
                $updateReserveResult = mysqli_query($conn, $updateReserveSql);
                if ($updateReserveResult) {
                    $bookIssueSuccess = true;
                } else {
                    $bookIssueFail = "Some Error Occurred. Try again.";
                }
            } else {
                $bookIssueFail = "Some Error Occurred. Try again.";
            }
        }

    } else {
        $bookIssueFail = "Fields Can't be Empty.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book - BookHub</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Issue Book</h1>
            <div class="addformContain">

                <form action="issuebook.php" class="addForm" method="post">
                    <select name="userList" id="userList" class="dataEntryInput selectItems">
                        <option value="issueUserOptDefault" selected id="defaultUserSelect" class="selectOptions">Select Member</option>
                        <?php
                        $fetchUserQuery = "SELECT username from members";
                        $fetchUserResult = mysqli_query($conn, $fetchUserQuery);
                        if (mysqli_num_rows($fetchUserResult) > 0) {;
                            while ($row1 = mysqli_fetch_assoc($fetchUserResult)) {
                                echo '<option class="selectOptions" value="' . $row1['username'] . '">' . $row1['username'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <select name="bookList" id="bookList" class="dataEntryInput selectItems">
                        <option value="issueBookOptDefault" selected id="defaultBookSelect" class="selectOptions">Select Book</option>
                        <?php
                        $fetchBookQuery = "SELECT bookname from books where copiesavailable!=0";
                        $fetchBookResult = mysqli_query($conn, $fetchBookQuery);
                        if (mysqli_num_rows($fetchBookResult) > 0) {;
                            while ($row1 = mysqli_fetch_assoc($fetchBookResult)) {
                                echo '<option value="' . $row1['bookname'] . '">' . $row1['bookname'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="text" name="issuedate" id="issuedate" readonly class="dataEntryInput" placeholder="Issue Date">
                    <input type="text" name="toreturndate" id="toreturndate" readonly class="dataEntryInput" placeholder="Return Deadline">
                    <p class="returnDateNote" id="returnDateNote">To be returned within 1 month</p>

                    <input type="submit" value="Issue Book" id="bookissueBtn" class="addBtn">
                </form>
            </div>
        </div>
    </div>
    <script>
    let issueDateInp = document.getElementById("issuedate");
    let toReturnDateInp = document.getElementById("toreturndate");

    let currentDate = new Date();
    let year = currentDate.getFullYear();
    let month = String(currentDate.getMonth() + 1).padStart(2, '0');
    let day = String(currentDate.getDate()).padStart(2, '0');
    let issueDate = `${year}-${month}-${day}`;
    // issueDateInp.value = "Issue Date: " + issueDate

    let nextMonthDate = new Date(currentDate)
    nextMonthDate.setMonth(currentDate.getMonth() + 1)
    let returnyear = nextMonthDate.getFullYear();
    let returnmonth = String(nextMonthDate.getMonth() + 1).padStart(2, '0');
    let returnday = String(nextMonthDate.getDate()).padStart(2, '0');
    let returnDate = `${returnyear}-${returnmonth}-${returnday}`
    // toReturnDateInp.value = "Return Date: " + returnDate
    
    issueDateInp.addEventListener("click", function(e) {
        e.target.value = issueDate
    })
    toReturnDateInp.addEventListener("click", function(e) {
        e.target.value = returnDate
    })
</script>
<?php
if ($bookIssueFail != false) {
    echo '<script>
    let returnDateNote = document.getElementById("returnDateNote");
    let bookissueError = document.createElement("p");
    bookissueError.classList.add("entryErrorShow");
    bookissueError.innerText = "' . $bookIssueFail . '";
    returnDateNote.insertAdjacentElement("afterend", bookissueError);
</script>';
}
if ($bookIssueSuccess) {
    echo '<script>
    let returnDateNote = document.getElementById("returnDateNote");
    let bookissueSuccess = document.createElement("p");
    bookissueSuccess.classList.add("entrySuccessShow");
    bookissueSuccess.innerText = "Book Issued Successfully !";
    returnDateNote.insertAdjacentElement("afterend", bookissueSuccess);
</script>';
}
?>
</body>

</html>