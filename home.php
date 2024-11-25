<?php
require_once("./auth/isLogin.php");

// var_dump($user['role']);
if($user['role'] == 1){
    header("Location:./admin/index.php");
} elseif($user['role'] == 2){
    header("Location:./cashier/index.php");
} elseif($user['role'] == 3){
    header("Location:./kitchen/index.php");
} elseif($user['role'] == 4){
    header("Location:./waiter/index.php");
}