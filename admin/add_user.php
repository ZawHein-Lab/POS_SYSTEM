<?php require_once("../layout/header.php");
require_once("../auth/isLogin.php")
?>

<?php
$fileName_err = "";
$user_name = $user_name_err = "";
$user_email = $user_email_err = "";
$password  = $password_err = "";
$confirm_password = $confirm_password_err = "";
$role = $role_err = "";
$old_password_err = "";
$fail_query = "";
$invalid = true;
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // echo $user_id;
    $users =  get_user_with_id($mysqli, $user_id);
    //var_dump($users);
    $user_name = $users['username'];
    $user_email = $users['useremail'];
    $profile_name = $users['image'];
    $role = $users['role'];
    $old_user_password = $users['password'];
}
if (isset($_POST['submit'])) {
    $user_name = $_POST['username'];
    $user_email = $_POST['useremail'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $role = $_POST['role'];

    $fileTmpPath = $_FILES['profile']['tmp_name'];
    $fileName = $_FILES['profile']['name'];
    $fileSize = $_FILES['profile']['size'];
    $fileType = $_FILES['profile']['type'];

    if ($user_name === "") {
        $user_name_err = "Name cann't be blank";
        $invalid = false;
    } else {
        if (!preg_match('/^[a-zA-Z0-9]{1,30}$/', $user_name)) {
            $user_name_err = "Invalid username";
            $invalid = false;
        }
    }

    if ($user_email === "") {
        $user_email_err = "Email cann't be blank";
        $invalid = false;
    } else {
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ ", $user_email)) {
            $user_email_err = "Please enter email format!";
            $invalid = false;
        }
    }
    if (!isset($_GET['user_id'])) {
        if ($fileName === "") {
            $fileName_err = "Please choose image";
            $invalid = false;
        }
    }

    if ($role === "") {
        $role_err = "Please select role";
        $invalid = false;
    }

    if ($password === "") {
        $password_err = "Password cann't be blank";
        $invalid = false;
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,20}$/', $password)) {
            $password_err = "Invalid password format (Hein@123)";
            $invalid = false;
        }
    }
    if ($confirm_password === "") {
        $confirm_password_err = "Confirm Password cann't be blank";
        $invalid = false;
    }
    if ($password !== $confirm_password) {
        $confirm_password_err = "Password not match. Try again!";
        $invalid = false;
    }
    if ($invalid === true) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $get_password =  get_password_with_currentuserid($mysqli, $user_id);
            $oldImageName = $get_password['image'];
            $hashedOldPassword = $get_password['password'];
            // var_dump($oldImageName);
            $old_password = $_POST['old_password'];
            if ($old_password == '') {
                $old_password_err = "Current password cann't be blank";
            }
            if (password_verify($old_password,  $hashedOldPassword)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // var_dump($oldImageName);
                // $fileName = $_FILES['profile']['name'];
                if (!file_exists($fileName)) {
                    $get_password =  get_password_with_currentuserid($mysqli, $user_id);
                    $oldImageName = $get_password['image'];
                    // $fileName = $oldImageName;
                    //  var_dump($oldImageName);
                    $status = update_user($mysqli, $user_name, $user_email, $oldImageName, $hashedPassword, $role, $user_id);
                    if ($status === true) {
                        // move_uploaded_file($tmp_name, "../assets/image/" . $base64Image);
                        // header("Location:./user_list.php");
                        echo "<script>location.replace('./user_list.php')</script>";
                    } else {
                        $fail_query = $status;
                    }
                }
                if (isset($_FILES['profile'])) {
                    if(isset($_POST['profile'])){
                        $get_password =  get_password_with_currentuserid($mysqli, $user_id);
                        $oldImageName = $get_password['image'];
                        $filePath = '../assets/image/' . $oldImageName;
                        // Check if the file exists
                        if (file_exists($filePath)) {
                            // Attempt to delete the file
                            if (unlink($filePath)) {
                                echo "The file 'profile.png' was deleted successfully.";
                            }
                        }
                    }

                    $fileName = $_FILES['profile']['name'];
                    $fileTmpPath = $_FILES['profile']['tmp_name'];
                    // var_dump($fileName);
                    $targetDir = '../assets/image/';
                    $newFileName = uniqid('img_') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);  // Generate a unique file name
                    $targetFilePath = $targetDir . $newFileName;
                    // $imageData = file_get_contents($fileTmpPath);
                    // $base64Image = base64_encode($imageData);
                    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                        // Convert the image file to base64

                        $status = update_user($mysqli, $user_name, $user_email,  $newFileName, $hashedPassword, $role, $user_id);
                        if ($status === true) {
                            // move_uploaded_file($tmp_name, "../assets/image/" . $base64Image);
                            // header("Location:./user_list.php");
                            echo "<script>location.replace('./user_list.php')</script>";
                        } else {
                            $fail_query = $status;
                            // echo $fail_query;
                        }
                    }
                }
            } else {
                $old_password_err = "Current password does not match";
            }
        } else {
            $targetDir = '../assets/image/';
            $newFileName = uniqid('img_') . '.' . pathinfo($fileName, PATHINFO_EXTENSION);  // Generate a unique file name
            $targetFilePath = $targetDir . $newFileName;
            // $imageData = file_get_contents($fileTmpPath);
            // $base64Image = base64_encode($imageData);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                // Convert the image file to base64
                $status = save_user($mysqli, $user_name, $user_email, $newFileName, $hashedPassword, $role);
                if ($status === true) {
                    // move_uploaded_file($tmp_name, "../assets/image/" . $base64Image);
                    header("Location:./user_list.php");
                } else {
                    $fail_query = $status;
                    // echo $fail_query;
                }
            }
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
                <?php
                if (isset($_GET['user_id'])) { ?>
                    <div class="card-title mx-auto mt-2 mb-1 fs-3">Update User</div>
                <?php } else { ?>
                    <div class="card-title mx-auto mt-2 mb-1 fs-3">Add User</div>
                <?php } ?>
                <div class="card-body">
                    <?php if ($fail_query === "") {
                    } else { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $fail_query ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php   }  ?>
                    <form action="" method="POST" class="form-group" enctype="multipart/form-data">
                        <div class="form-input-group-sm mb-2">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" name="username" value="<?= $user_name ?>" id="username" class="form-control" placeholder="Eneter user name....">
                            <i class="text-danger text-sm-start"><?= $user_name_err ?></i>
                        </div>
                        <div class="form-input-group-sm mb-2">
                            <label for="useremail" class="form-label">Email</label>
                            <input type="email" name="useremail" value="<?= $user_email ?>" id="useremail" class="form-control" placeholder="Eneter user email.....">
                            <i class="text-danger text-sm-start"><?= $user_email_err ?></i>
                        </div>
                        <div class="form-input-group-sm mb-2">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="" selected>Select Role</option>
                                <option value="1" <?php if ($role == "1") {
                                                        echo "selected";
                                                    } ?>>Admin</option>
                                <option value="2" <?php if ($role == "2") {
                                                        echo "selected";
                                                    } ?>>Cashier</option>
                                <option value="3" <?php if ($role == "3") {
                                                        echo "selected";
                                                    } ?>>Kitchen</option>
                                <option value="4" <?php if ($role == "4") {
                                                        echo "selected";
                                                    } ?>>Waiter</option>
                            </select>
                            <i class="text-danger text-sm-start"><?= $role_err ?></i>
                        </div>
                        <div class="form-input-group-sm mb-2">
                            <label for="profile" class="form-label">Photo</label>
                            <input type="file" value="<?= $profile_name ?>" name="profile" id="profile" class="form-control">
                            <i class="text-danger text-sm-start"><?= $fileName_err ?></i>
                        </div>
                        <?php if (isset($_GET['user_id'])) { ?>
                            <div class="form-input-group-sm mb-2">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Eneter user password.....">
                            </div>
                        <?php } ?>
                        <div class="form-input-group-sm mb-2">
                            <?php if (isset($_GET['user_id'])) { ?>
                                <label for="confirmPassword" class="form-label">New Password</label>
                            <?php } else { ?>
                                <label for="Password" class="form-label">Password</label>
                            <?php } ?>
                            <input type="password" value="<?= $password ?>" name="password" id="password" class="form-control" placeholder="Eneter user password.....">
                            <i class="text-danger text-sm-start"><?= $password_err ?></i>
                        </div>
                        <div class="form-input-group-sm mb-2">
                            <?php if (isset($_GET['user_id'])) { ?>
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <?php } else { ?>
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <?php } ?>
                            <input type="password" value="<?= $confirm_password ?>" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Eneter user same password.....">
                            <i class="text-danger text-sm-start"><?= $confirm_password_err ?></i>
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