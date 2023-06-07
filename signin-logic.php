<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    // lấy dữ liệu
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$username_email){
        $_SESSION['signin'] = "Tên đăng nhập hoặc Email là bắt buộc!";
    }elseif(!$password){
        $_SESSION['signin'] = "Mật khẩu là bắt buộc!";

    }else{
        // tìm user có trong database
        $fetch_user_query = " SELECT * FROM users WHERE username='$username_email' OR email='username_email'";  
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);
        
        if(mysqli_num_rows($fetch_user_result)==1){
            //chuyển đổi bản ghi thành 1 mảng
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            //so sánh mk với mk trên database
            if(password_verify($password, $db_password)){
                $_SESSION['user-id'] = $user_record['id'];
                if($user_record['is_admin']==1){
                    $_SESSION['user_is_admin'] = true;
                }
                header('location: ' . ROOT_URL . 'admin/');
            }else{
                $_SESSION['signin']= "Vui lòng kiểm tra giá trị nhập vào!";
        }
        }   else{  
            $_SESSION['signin']= "Không tìm thấy người dùng!";
        }
    }
        //nếu có lỗi => quay lại trag đăng kí
        if(isset($_SESSION['signin'])){
            $_SESSION['signin-data'] = $_POST;
            header('location: '. ROOT_URL . 'signin.php');
            die();
        }
}else{
    header('location: '. ROOT_URL . 'signin.php');
    die();

}