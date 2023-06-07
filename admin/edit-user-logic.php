<?php
require 'config/database.php';
if(isset($_POST['submit'])){
    // lấy form cập nhật data
    $id= filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    
    //kiểm tra đàu vào hợp lệ
    if(!$firstname || !$lastname){
        $_SESSION['edit-user']= "Giá trị nhập vào không hợp lệ!";
    }else{
        //update user
        $query = "UPDATE users SET firstname= '$firstname', lastname='$lastname', is_admin= $is_admin WHERE id= $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
        $_SESSION['edit-user'] = "Cập nhật không thành công!";
        }else{
            $_SESSION['edit-user-success'] = "Nguời dùng $lastname $firstname được cập nhật thành công!";
        }
    }
}

header('location:'. ROOT_URL . 'admin/manage-users.php');
die();