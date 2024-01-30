<?php
    require '_dbconnect.php';
    $categoryAddSuccess = false;
    $categoryAddFail = false;
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $categoryname = $_POST['categoryname'];
        if ($categoryname!="") {
            $searchcategoryQuery = "SELECT * from category where categoryname='$categoryname'";
            $searchcategoryResult = mysqli_query($conn, $searchcategoryQuery);
            if (mysqli_num_rows($searchcategoryResult)>0) {
                $categoryAddFail = "Category Already Exists.";
            } else {
                $addcategoryQuery = "INSERT INTO category(categoryname) VALUES('$categoryname')";
                $addcategoryResult = mysqli_query($conn, $addcategoryQuery);
                if ($addcategoryResult) {
                    $categoryAddSuccess= true;
                } else {
                    $categoryAddFail = "Some Error Occured. Try again.";
                }
            }
            
        } else {
            $categoryAddFail = "Field is blank.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - BookHub</title>
    <?php require_once 'links.php' ?>
</head>

<body>
    <div class="pageFlex">
        <?php require_once 'nav.php' ?>
        <div class="mainPage pageFlexElement">
            <h1 class="pageTitle">Add Category</h1>
            <div class="addformContain">

                <form action="addcategory.php" class="addForm" method="post">
                    <input type="text" class="dataEntryInput" id="categoryname" name="categoryname" placeholder="Enter Category">

                    <input type="submit" value="Add Category" id="addcategoryBtn" class="addBtn">
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($categoryAddFail != false) {
        echo '<script>
            let categoryname = document.getElementById("categoryname");
            let categoryaddError = document.createElement("p");
            categoryaddError.classList.add("entryErrorShow");
            categoryaddError.innerText = "' . $categoryAddFail . '";
            categoryname.insertAdjacentElement("afterend", categoryaddError);
        </script>';
    }
    if ($categoryAddSuccess) {
        echo '<script>
            let categoryaddBtn = document.getElementById("addcategoryBtn");
            let categoryaddSuccess = document.createElement("p");
            categoryaddSuccess.classList.add("entrySuccessShow");
            categoryaddSuccess.innerText = "Category Added Successfully !";
            categoryaddBtn.insertAdjacentElement("afterend", categoryaddSuccess);
        </script>';
    }
    ?>

</body>

</html>