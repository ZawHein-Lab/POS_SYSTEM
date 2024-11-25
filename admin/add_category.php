<?php require_once("../layout/header.php");
require_once("../auth/isLogin.php")
?>
<?php
$category_name = $category_name_err = "";
if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];
    // echo $category_name;
    if ($category_name == "") {
        $category_name_err = "Category name cann't be blank";
    }
    if ($category_name_err == "") {
        $status = save_category($mysqli, $category_name);
        if ($status) {
            echo 'Category Created Successfully';
        }
    }
}
?>


<div class="main">
    <?php require_once("../layout/sidebar.php") ?>
    <div class="content w-100">
        <?php require_once("../layout/navbar.php") ?>
        <div class="main-content mt-2">
            <div class="card w-50 mx-auto">
                <div class="card-title mx-auto mt-2 mb-1 fs-3">Add Category</div>
                <div class="card-body">

                    <form action="" method="POST" class="form-group" enctype="multipart/form-data">
                        <div class="form-input-group-sm mb-2">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Eneter category name.....">
                            <i class="text-danger text-sm-start"></i>
                        </div>
                        <div class="form-input-group-sm text-center">
                            <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once("../layout/footer.php"); ?>