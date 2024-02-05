<?php
require '_dbconnect.php';
session_start();
if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: userlogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BookHub </title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Admin Dashboard</h1>
            <div class="adminDashGrid">
                <div class="gridCol1 gridCol">
                <div class="insideDashGrid bookIssuesToday">
                    
                    <h2 class="gridTopic">Book Issued Today</h2>
                        <?php
                    $currentDate = date("Y-m-d");
                    // echo $currentDate;
                    $bookIssuesTodayQuery = "SELECT books.bookid, books.bookname, books.booknumber, COUNT(bookissued.bookid) as noofcopies FROM bookissued JOIN books ON bookissued.bookid = books.bookid WHERE bookissued.issuedate = '$currentDate' GROUP BY books.bookid, books.bookname, books.booknumber";
                    $bookIssuesTodayResult = mysqli_query($conn, $bookIssuesTodayQuery);

                    if (mysqli_num_rows($bookIssuesTodayResult) > 0) {
                        while ($rows1 = mysqli_fetch_assoc($bookIssuesTodayResult)) {
                            $bookname = strtoupper($rows1['bookname']);
                            // $booknumber = $rows1['booknumber'];
                            $noofcopies = $rows1['noofcopies'];
                            
                            echo '<p class="dashGridTexts">' . $bookname . ' (' . $noofcopies . ' copies)</p>';
                        }
                    } else {
                        echo "<p class='dashGridTexts'>No Book Issued Today.</p>";
                    }

                    ?>
                </div>
                    <div class="insideDashGrid bookFewSamples">
                        <h2 class="gridTopic">Books with Limited Copies in Stock</h2>
                        <?php
                        $fewSamplesBookQuery = "SELECT bookname, copiesavailable from books where copiesavailable < 6 order by copiesavailable";
                        $fewSamplesBookResult = mysqli_query($conn, $fewSamplesBookQuery);
                        
                        if (mysqli_num_rows($fewSamplesBookResult) > 0) {
                            while ($rows2 = mysqli_fetch_assoc($fewSamplesBookResult)) {
                                $bookname = strtoupper($rows2['bookname']);
                                $copiesavailable = $rows2['copiesavailable'];
    
                                echo '<p class="dashGridTexts">' . $bookname . ' (' . $copiesavailable . ' copies)</p>';
                            }
                        } else {
                            echo "<p class='dashGridTexts'>No Books wiht less than 5 copies in Stock.</p>";
                        }
                        ?>
                    </div>
                <div class="insideDashGrid booksNotReturnedAferDeadline">
                <h2 class="gridTopic">Books Not Returned After Deadline</h2>
                    <?php
                        $bookNoReturnDeadlineQuery = "SELECT books.bookname, members.username FROM bookissued JOIN books ON bookissued.bookid = books.bookid JOIN members ON bookissued.uid=members.uid WHERE bookissued.toreturndate < '$currentDate'";
                        $bookNoReturnDeadlineResult = mysqli_query($conn, $bookNoReturnDeadlineQuery);
                        
                        if (mysqli_num_rows($bookNoReturnDeadlineResult) > 0) {
                            while ($rows2 = mysqli_fetch_assoc($bookNoReturnDeadlineResult)) {
                                $bookname = strtoupper($rows2['bookname']);
                                $username = $rows2['username'];
                                
                                echo '<p class="dashGridTexts">' . $bookname . ' :' . $username. '</p>';
                            }
                        } else {
                            echo "<p class='dashGridTexts'>All Books returned Timely.</p>";
                        }
                        ?>
                </div>
            </div>
            <div class="gridCol2 gridCol">
                <div class="insideDashGrid usersHighLowCP">
                    <h2 class="gridTopic">Maximum Credit Point</h2>
                    <?php
                    $getHighCPQuery = "SELECT username, creditpoint as maxCP
                        FROM members
                        WHERE creditpoint = (SELECT MAX(creditpoint) FROM members);";
                    $getHighCPResult = mysqli_query($conn, $getHighCPQuery);

                    if (mysqli_num_rows($getHighCPResult) > 0) {
                        while ($rowsHighCp = mysqli_fetch_assoc($getHighCPResult)) {

                            $username = $rowsHighCp['username'];
                            $maxCP = $rowsHighCp['maxCP'];
                            echo '<p class="dashGridTexts">' . $username . ' (' . $maxCP . ' Credit Point)</p>';
                        }
                    }

                    ?>
                    <h2 class="gridTopic">Minimum Credit Point</h2>
                    <?php
                    $getLowCPQuery = "SELECT username, creditpoint as minCP
                        FROM members
                        WHERE creditpoint = (SELECT MIN(creditpoint) FROM members);";
                    $getLowCPResult = mysqli_query($conn, $getLowCPQuery);

                    if (mysqli_num_rows($getLowCPResult) > 0) {
                        while ($rowsLowCp = mysqli_fetch_assoc($getLowCPResult)) {

                            $username = $rowsLowCp['username'];
                            $minCP = $rowsLowCp['minCP'];
                            echo '<p class="dashGridTexts">' . $username . ' (' . $minCP . ' Credit Point)</p>';
                        }
                    }

                    ?>

                </div>
                <div class="insideDashGrid usersaddedFewDays">
                    <h2 class="gridTopic">New Users</h2>
                    <?php
                    $recentUserQuery = "SELECT username, regdate
                    FROM members
                    WHERE DATE(regdate) >= (CURRENT_DATE - INTERVAL 5 day)
                    ";
                    $recentUserResult = mysqli_query($conn, $recentUserQuery);
                    if (mysqli_num_rows($recentUserResult)>0) {
                        while($rowsRecentUser = mysqli_fetch_assoc($recentUserResult)) {   
                            $username = $rowsRecentUser['username'];
                            $regdate = $rowsRecentUser['regdate'];
                            echo '<p class="dashGridTexts">' . $username . ' :' . $regdate. '</p>';
                        }
                    } else {
                        echo "<p class='dashGridTexts'>No New Users.</p>";
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>