<?php require_once("../layout/header.php");
require_once("../auth/isLogin.php")
 ?>

<?php
$user_name = $user_name_err = "";
$user_email = $user_email_err = "";
$password  = $password_err = "";
$confirm_password = $confirm_password_err=""; 
$role = $role_err ="";
$fail_query= "";
$invalid = true;
if(isset($_POST['submit'])){
    $user_name =$_POST['username'];
    $user_email = $_POST['useremail'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $role = $_POST['role'];
    // echo $user_name;
    // echo $role;
    if($user_name === ""){
        $user_name_err = "Name cann't be blank";
        $invalid = false;
    } else
    {
        if (!preg_match('/^[a-zA-Z0-9]{1,30}$/', $user_name)) {
                $user_name_err = "Invalid username";
                $invalid = false;
        }
    }
    if($user_email === ""){
        $user_email_err = "Email cann't be blank";
        $invalid = false;
    } else{
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ ", $user_email)) {
                $user_email_err = "Please enter email format!";
                $invalid = false;
        }
    }
    if($role ===""){
        $role_err = "Please select role";
        $invalid = false;
    }
    if($password === ""){
        $password_err = "Password cann't be blank";
        $invalid = false;
    }
    else
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,20}$/', $password)) {
            $password_err = "Invalid password format (Hein@123)";
            $invalid = false;
        } 
    }
    if($confirm_password === ""){
        $confirm_password_err = "Confirm Password cann't be blank";
        $invalid = false;
    }
    if($password !== $confirm_password){
        $confirm_password_err = "Password does not match. Try again!";
        $invalid = false;
    }
    if($invalid === true){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // echo $hashedPassword;
        $status =save_user($mysqli, $user_name, $user_email, $hashedPassword, $role);
        // if($status){
        //     header("Location:./user_list.php");
        // }
        if ($status === true) {
            header("Location:./user_list.php");
        } else {
            $fail_query = $status;
            // echo $fail_query;
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
                <div class="card-title mx-auto mt-2 mb-1 fs-3">Add User</div>
                <div class="card-body">
                <?php if($fail_query === ""){}else{ ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?= $fail_query?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php   }  ?> 
                    <form action="" method="POST" class="form-group">
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
                                <option value="" selected >Select Role</option>
                                <option value="1" <?php if($role=="1") {echo "selected";} ?> >Admin</option>
                                <option value="2" <?php if($role=="2") {echo "selected";} ?> >Cashier</option>
                                <option value="3" <?php if($role=="3") {echo "selected";} ?> >Kitchen</option>
                                <option value="4" <?php if($role=="4") {echo "selected";} ?> >Waiter</option>
                            </select>
                            <i class="text-danger text-sm-start"><?= $role_err ?></i>
                        </div>
                        <div class="form-input-group-sm mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" value="<?= $password ?>" name="password" id="password" class="form-control" placeholder="Eneter user password.....">
                            <i class="text-danger text-sm-start"><?= $password_err ?></i>
                        </div>
                        <div class="form-input-group-sm mb-2">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" value="<?= $confirm_password?>" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Eneter user same password.....">
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