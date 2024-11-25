<?php
function save_category($mysqli, $categoryname)
{
    try {
        $sql = "INSERT INTO `category`(`categoryname`) VALUES('$categoryname')";
        return $mysqli->query($sql);
    } catch (\Throwable $th) {
         {
            return "Internal server error!";
        }
    }   
}
function get_category_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `category` WHERE `id` = $id";
    $category = $mysqli->query($sql);
    return $category->fetch_assoc();
}
// function update_user($mysqli,$user_name,$user_email,$profile_name,$password,$role,$user_id){
//     $sql = "UPDATE `user` SET(`username` = '$user_name',`useremail` ='$user_email',`image` = '$profile_name',`password` = '$password',`role` = $role)  WHERE `id`=$user_id";
//     return $mysqli->query($sql);
// }
function update_category($mysqli, $category_name, $category_id) {
    $sql = "UPDATE `category` 
            SET `categoryname` = '$category_name',
            WHERE `id` = $category_id";
    return $mysqli->query($sql);
}

function delete_category($mysqli,$category_id){
    $sql = "DELETE FROM `category` WHERE `id`=$category_id";
    return $mysqli->query($sql);
}
function get_category($mysqli)
{
    $sql = "SELECT * FROM `category`";
    return $mysqli->query($sql);
}
function get_category_with_search_data($mysqli,$search){
    $sql = "SELECT * FROM `user` WHERE `categoryname` LIKE '%$search%'";
    return $mysqli->query($sql);

}