<?php
function save_user($mysqli, $username, $useremail, $password, $role)
{
    try {
        $sql = "INSERT INTO `user`(`username`,`useremail`,`password`,`role`) VALUES('$username', '$useremail', '$password', '$role')";
        return $mysqli->query($sql);
    } catch (\Throwable $th) {
        if ($th->getCode() === 1062) {
            return "This email is alerady have been used!";
        } else {
            return "Internal server error!";
        }
    }   
}
function get_user_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `user` WHERE `id` = $id";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}
function delete_user($mysqli,$id){
    $sql = "DELETE FROM `user` WHERE `id`=$id";
    return $mysqli->query($sql);
}
function get_users($mysqli)
{
    $sql = "SELECT * FROM `user`";
    return $mysqli->query($sql);
}
function get_data_with_search_data($mysqli,$search){
    $sql = "SELECT * FROM `user` WHERE `username` LIKE '%$search%'";
    return $mysqli->query($sql);

}
function get_user_with_offset($mysqli,$offset,$limit){
    $sql = "SELECT * FROM user LIMIT $limit OFFSET $offset";
    return $mysqli->query($sql);
}
function get_user_with_email($mysqli, $email)
{
    $sql = "SELECT * FROM `user` WHERE `useremail`='$email'";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}
