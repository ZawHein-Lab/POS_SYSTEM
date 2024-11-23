<?php

try {
    $mysqli = new mysqli("localhost","root","");
    $sql = "CREATE DATABASE IF NOT EXISTS `pos_system`";
    if($mysqli->query($sql)){
        if($mysqli->select_db("pos_system")){
            create_table($mysqli);
        }
    }
} catch (\Throwable $th) {
    var_dump($th);
    echo "Can not connect to Database!";
    die();
}

// auto create all table when our index page is loaded
function create_table($mysqli){
    $sql = "CREATE TABLE IF NOT EXISTS `user`(`id` INT AUTO_INCREMENT,`username` VARCHAR(70) NOT NULL,`useremail` VARCHAR(70) UNIQUE,`password` VARCHAR(220) NOT NULL,`role` INT NOT NULL,PRIMARY KEY(`id`))";
    // var_dump($mysqli->query($sql));
    if(!$mysqli->query($sql)){
        return false;
    }
    return true;
}
// function save_user($mysqli){
//     $sql = "INSERT INTO `user`(`username`,`useremail`,`password`,`role`)  VALUES('admin','admin@gmail.com','password',1)";
//     return $mysqli->query($sql);
// }
?>