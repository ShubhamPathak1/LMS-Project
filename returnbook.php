<?php

function creditPointControl($conn, $uid, $trdate, $rdate) {
    $toreturndate= new DateTime($trdate);
    $returningdate = new DateTime($rdate);
    if ($returningdate < $toreturndate) {
        $earlyInterval = date_diff($toreturndate, $returningdate);
        $earlyDays = $earlyInterval->days;
        // if ($earlyDays>10) {
        //     $changeCP = 0;
        // } else {
        //     $changeCP = $earlyDays * 10;
        // }
        $changeCP = $earlyDays * 10;
    } elseif ($returningdate > $toreturndate) {
        $lateInterval = date_diff($toreturndate, $returningdate);
        $lateDays = $lateInterval->days;
        $changeCP = -($lateDays * 20);
    } else {
        $changeCP = 0;
    }
    $editCPQuery = "UPDATE members set creditpoint = creditpoint + $changeCP where uid=$uid";
    $editCPResult = mysqli_query($conn, $editCPQuery);
    return $editCPResult;
}
require '_dbconnect.php';
$bookReturnSuccess = false;
$bookReturnFail = false;
if ($_SERVER['REQUEST_METHOD']=="POST") {
    $username = $_POST['userList'];
    $bookname = $_POST['bookList'];
    $returningdate = $_POST['returningdate'];
    if ($bookname!="issueBookOptDefault" && $username!="issueUserOptDefault") {
        $returnQuery = "SELECT bookissued.bookid, bookissued.uid, bookissued.issueid, bookissued.issuedate, bookissued.toreturndate from bookissued join books on bookissued.bookid=books.bookid join members on bookissued.uid=members.uid where members.username='$username' and books.bookname='$bookname'";
        $returnResult = mysqli_query($conn, $returnQuery);
        if (mysqli_num_rows($returnResult)==1) {
            $rowsR = mysqli_fetch_assoc($returnResult);
            $bookid = $rowsR['bookid'];
            $uid = $rowsR['uid'];
            $issueid = $rowsR['issueid'];
            $issuedate = $rowsR['issuedate'];
            $toreturndate = $rowsR['toreturndate'];

            $removefromIssuedQuery = "DELETE from bookissued where issueid=$issueid";
            $removefromIssuedResult = mysqli_query($conn, $removefromIssuedQuery);
            $incCopiesQuery = "UPDATE books set copiesavailable=copiesavailable+1 where bookid=$bookid";
            $incCopiesResult = mysqli_query($conn, $incCopiesQuery);
            
            $editCPResult = creditPointControl($conn, $uid, $toreturndate, $returningdate);

            if ($removefromIssuedResult && $incCopiesResult && $editCPResult) {
                $bookReturnSuccess = true;
            } else {
                $bookReturnFail = "Some error occured. Try again.";
            }
        } else {
            $bookReturnFail = "This book hasn't been issued to this user.";
        }
    } else {
        $bookReturnFail = "Fields can't be empty.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book - BookHub</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Return Book</h1>
            <div class="addformContain">
                
                <form action="returnbook.php" class="addForm" method="post">
                    <select name="userList" id="userList" class="dataEntryInput selectItems">
                        <option value="returnUserOptDefault" selected id="defaultUserSelect" class="selectOptions">Select Member</option>
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
                        <option value="returnBookOptDefault" selected id="defaultBookSelect" class="selectOptions">Select Book</option>
                        <?php
                        // $username = $_GET['username'];
                        // $fetchBookQuery = "SELECT bookissued.bookid, books.bookname, bookissued.uid, members.username from bookissued join books on bookissued.bookid=books.bookid join members on bookissued.uid=members.uid where members.username='$username'";
                        $fetchBookQuery = "SELECT bookname from books";
                        $fetchBookResult = mysqli_query($conn, $fetchBookQuery);
                        if (mysqli_num_rows($fetchBookResult) > 0) {;
                            while ($row1 = mysqli_fetch_assoc($fetchBookResult)) {
                                echo '<option value="' . $row1['bookname'] . '">' . $row1['bookname'] . '</option>';
                            }
                            }
                        ?>
                    </select>
                    <input type="text" name="returningdate" id="returningdate" readonly class="dataEntryInput" placeholder="Returning Date">
                    <input type="submit" value="Return Book" id="bookreturnBtn" class="addBtn">
                </form>
            </div>
        </div>
    </div>

<script>
    let returningDateInp = document.getElementById("returningdate")
    let currentDate = new Date();
    let year = currentDate.getFullYear();
    let month = String(currentDate.getMonth() + 1).padStart(2, '0');
    let day = String(currentDate.getDate()).padStart(2, '0');
    let returningDate = `${year}-${month}-${day}`;
    returningDateInp.addEventListener("click", function(e) {
        e.target.value = returningDate
    })
        
</script>
<?php
        if ($bookReturnFail!=false) {
            echo '<script>
            let returningdateInp = document.getElementById("returningdate");
            let bookReturnError = document.createElement("p");
            bookReturnError.classList.add("entryErrorShow");
            bookReturnError.innerText = "' . $bookReturnFail . '";
            returningdateInp.insertAdjacentElement("afterend", bookReturnError);
        </script>';
        }
        if ($bookReturnSuccess) {
            echo '<script>
            let returningdateInp = document.getElementById("returningdate");
            let bookReturnSuccess = document.createElement("p");
            bookReturnSuccess.classList.add("entrySuccessShow");
            bookReturnSuccess.innerText = "Book Returned!";
            returningdateInp.insertAdjacentElement("afterend", bookReturnSuccess);
        </script>';
        }

    ?>
</body>

</html>