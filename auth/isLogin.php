<?php
$user = json_decode($_COOKIE["user"], true);
if (!$user) {
    header( "Location:index.php?invalid=Please login first!");
} else{
    $url = $_SERVER['REQUEST_URI'];
    $arr = explode('/',$url);
    // var_dump($arr);
    $code = 0;
    // var_dump($arr[count($arr)-2]);
    if($arr[count($arr)-2] !== "POS_system"){
        $role_name = $arr[count($arr)-2];
       switch ($role_name) {
        case 'admin':
            $code = 1;
            break;
        case 'cashier':
            $code = 2;
            break;
        case 'kitchen':
            $code = 3;
            break;
        case 'waiter':
            $code = 4;
            break;    
       
       }
    }
    if($code != $user['role']){
        header('Location:../401.php');
    }
}
if(isset($_POST['logout'])){
    setcookie("user",'',-1,"/");
    header('Location:../index.php');
}
// function isKitchen($user){
//     if($user['role'] != 3){
//         header("Location:../401.php");
//     }
// }

