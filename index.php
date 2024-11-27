<?php require_once("./storage/db.php"); ?>
<?php require_once("./storage/user_crud.php"); ?>
<?php
if (isset($_COOKIE['user'])) {
    header("location:./home.php");
}
// $users = get_users($mysqli);
// $users = $users->fetch_all();
// $admin_user = array_filter($users, function ($user) {
//     return $user[4] == 1;
// });
// if (!$admin_user) {
//     $admin_password = password_hash("password", PASSWORD_BCRYPT);
//     save_user($mysqli, "admin", "admin@gmail.com", "profile.png", $admin_password, 1);
// }
if (have_admin($mysqli)) {
    $admin_password = password_hash("password", PASSWORD_BCRYPT);
    save_user($mysqli, "admin", "admin@gmail.com", "profile.png", $admin_password, 1);
    // save_user($mysqli, $username, $useremail, $profile, $password, $role)
}

$email = $email_err = $password = $password_err = "";
//   $pattern = '/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/';
if (isset($_POST['useremail'])) {
    $email = $_POST['useremail'];
    $password = $_POST['password'];

    if ($email === "") {
        $email_err = "Email cann't be blank!";
    }
    if ($password === "") {
        $password_err = "Password cann't be blank!";
    }
    if ($email_err === "" && $password_err === "") {
        $user = get_user_with_email($mysqli, $email);
        // var_dump($user);
        if (!$user) {
            $email_err = "User does not exist!";
        } else {
            if (password_verify($password, $user['password'])) {
                setcookie("user", json_encode($user), time() + 60 * 60 * 24 * 30, "/");
                header("Location:./home.php");
            } else {
                $password_err = "Password does not match!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sale System</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script src="./assets/js/jquery.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="card mx-auto w-50" style="margin-top: 120px;">
        <div class="mb-5 mt-4">
            <div class="card-title w-75 mx-auto">
                <h3 class="text-center mb-2">Login Form</h3>
                <?php if (isset($_GET['invalid'])) { ?>
                    <!-- <div class="alert alert-danger"><?= $_GET['invalid'] ?></div> -->
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?= $_GET['invalid'] ?></strong>
                        <button type="button" class=" btn-close close" data-bs-dismiss="alert" aria-label="Close">
                            <!-- <span aria-hidden="true">&times;</span> -->
                        </button>
                    </div>
                <?php } ?>
            </div>
            <form class="form-group w-75 mx-auto" method="POST">
                <label for="useremail" class="form-label">Email</label>
                <input type="email" name="useremail" id="useremail" class="form-control mb-2">
                <div class="text-danger" style="font-size:12px;"><?= $email_err ?></div>

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control mb-2">
                <div class="text-danger" style="font-size:12px;"><?= $password_err ?></div>

                <input type="checkbox" name="showPassword" id="showPassword" class="form-check-input">
                <label for="showPassword" class="form-label">showPassword</label>

                <div class="text-center mt-3">
                    <input type="submit" value="Login" class="btn btn-info w-50">
                </div>
            </form>
        </div>
    </div>
    <script>
        $(() => {
            let password = $("#password");
            let showPassword = $("#showPassword");
            showPassword.on("click", () => {
                // console.log("hello");
                if (showPassword.is(":checked")) {
                    // console.log(showPassword);
                    password.get(0).type = "text";
                } else {
                    password.get(0).type = "password";
                }
            })
        })
    </script>
</body>

</html>