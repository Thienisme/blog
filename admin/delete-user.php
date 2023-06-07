<?php
require 'config/database.php';

if(isset($_GET['id'])){
    
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

//lấy user từ database
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)==1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/'. $avatar_name;

        //xóa ảnh nếu có sẵn
        if($avatar_path){
            unlink($avatar_path);
        }
    }   
    //tìm  tất cả các hình thu nhỏ của bài đăng của người dùng và xóa 





    // delete users từ database
    $delete_user_query = "DELETE  FROM users WHERE id=$id ";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)){
        $_SESSION['delete-user'] = "Không thể xóa người dùng '{$user['lastname']} {$user['firstname']}' ";
    }else{
        $_SESSION['delete-user-success'] = "Người dùng '{$user['lastname']} {$user['firstname']}' được xóa thành công!";
    }

}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();