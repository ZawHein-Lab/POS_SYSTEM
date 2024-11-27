<?php
try {
    $mysqli = new mysqli("localhost", "root", "");
    $sql = "CREATE DATABASE IF NOT EXISTS `pos_system`";
    if ($mysqli->query($sql)) {
        if ($mysqli->select_db("pos_system")) {
            create_table($mysqli);
        }
    }
} catch (\Throwable $th) {
    // var_dump($th);
    echo "Can not connect to Database!";
    die();
}

// auto create all table when our index page is loaded
function create_table($mysqli)
{
    $sql = "CREATE TABLE IF NOT EXISTS `user`(`id` INT AUTO_INCREMENT,`username` VARCHAR(70) NOT NULL,`useremail` VARCHAR(70) UNIQUE,`image` LONGTEXT NOT NULL,`password` VARCHAR(220) NOT NULL,`role` INT NOT NULL,PRIMARY KEY(`id`))";
    // var_dump($mysqli->query($sql));
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `category`(`category_id` INT AUTO_INCREMENT,`categoryname` VARCHAR(70) NOT NULL,PRIMARY KEY(`category_id`))";
    // var_dump($mysqli->query($sql));
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `item`(`item_id` INT AUTO_INCREMENT,`itemname` VARCHAR(70) NOT NULL,`price` int NOT NULL,category_id INT,PRIMARY KEY(`item_id`),FOREIGN KEY(`category_id`) REFERENCES `category`(`category_id`))";
    // var_dump($mysqli->query($sql));
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `table`(`table_id` INT AUTO_INCREMENT,`tablename` VARCHAR(70) NOT NULL,`seat` int NOT NULL,`taken` int NOT NULL,PRIMARY KEY(`table_id`))";
    // var_dump($mysqli->query($sql));
    if (!$mysqli->query($sql)) {
        return false;
    }
    $sql = "CREATE TABLE IF NOT EXISTS `invoice`(`invoice_id` INT AUTO_INCREMENT,`paid` INT NOT NULL,`qty` int NOT NULL,`table_id` INT ,item_id INT,PRIMARY KEY(`invoice_id`),FOREIGN KEY(`table_id`) REFERENCES `table`(`table_id`),FOREIGN KEY(`item_id`) REFERENCES `item`(`item_id`))";
    // var_dump($mysqli->query($sql));
    if (!$mysqli->query($sql)) {
        return false;
    }


    return true;
}

// function save_user($mysqli){
//     $sql = "INSERT INTO `user`(`username`,`useremail`,`password`,`role`)  VALUES('admin','admin@gmail.com','password',1)";
//     return $mysqli->query($sql);
// }
