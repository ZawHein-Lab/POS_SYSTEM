<?php
function save_user($mysqli, $username, $useremail, $profile, $password, $role)
{
    try {
        $sql = "INSERT INTO `user`(`username`,`useremail`,`image`,`password`,`role`) VALUES('$username', '$useremail','$profile', '$password', '$role')";
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
function have_admin($mysqli)
{
    $sql = "SELECT COUNT(`id`) as total FROM `user` WHERE `role`=1";
    $total = $mysqli->query($sql);
    $total = $total->fetch_assoc();
    if ($total['total'] > 0) {
        return false;
    }
    return true;
}
function update_user($mysqli, $user_name, $user_email, $profile_name, $password, $role, $user_id)
{
    $sql = "UPDATE `user` 
            SET `username` = '$user_name',
                `useremail` = '$user_email',
                `image` = '$profile_name',
                `password` = '$password',
                `role` = $role
            WHERE `id` = $user_id";
    return $mysqli->query($sql);
}

function delete_user($mysqli, $id)
{
    $sql = "DELETE FROM `user` WHERE `id`=$id";
    return $mysqli->query($sql);
}
function get_users($mysqli)
{
    $sql = "SELECT * FROM `user`";
    return $mysqli->query($sql);
}
function get_password_with_currentuserid($mysqli, $user_id)
{
    $sql = "SELECT `password` FROM `user` WHERE `id`= $user_id";;
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}
function get_data_with_search_data($mysqli, $search)
{
    $sql = "SELECT * FROM `user` WHERE `username` LIKE '%$search%'";
    return $mysqli->query($sql);
}
function get_user_with_offset($mysqli, $offset, $limit)
{
    $sql = "SELECT * FROM user LIMIT $limit OFFSET $offset";
    return $mysqli->query($sql);
}
function get_user_with_email($mysqli, $email)
{
    $sql = "SELECT * FROM `user` WHERE `useremail`='$email'";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}
