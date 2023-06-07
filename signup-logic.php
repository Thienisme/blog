<?php

require 'config/database.php';

//đăng kí nếu các nút trên form đăng kí đc nhấn trước đó
if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];
    
    //xác thực đầu vào
    if(!$firstname){
        $_SESSION['signup'] = "Vui lòng nhập tên của bạn!";
    }elseif(!$lastname){
        $_SESSION['signup'] = "Vui lòng nhập họ của bạn!";
    }elseif(!$username){
        $_SESSION['signup'] = "Vui lòng nhập tên đăng nhập!";
    }elseif(!$email){
        $_SESSION['signup'] = "Vui lòng nhập email hợp lệ!";
    }elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['signup'] = "Password nên lớn hơn 8 kí tự!";
    }elseif(!$avatar['name']){
        $_SESSION['signup'] = "Vui lòng chọn 1 hình ảnh hoặc thêm hình đại diện! ";
    }else{
        //ktra nếu password ko khớp
        if($createpassword != $confirmpassword){
            $_SESSION['signup']= "Mật khẩu không khớp!" ;
        } else {
            // băm password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT); 
            
            //kiểm tra tên đăng nhập & email có tồn tại trong CSDL chưa 
            $user_check_query= "SELECT * FROM users WHERE 
            username= '$username' OR email='$email' ";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['signup'] = "Tên đăng nhập hoặc Email đã tồn tại";
            } else{
                // xử lí ảnh
                // đổi tên ảnh
                $time = time(); // mỗi ảnh sẽ có tên duy nhất ứng với thời gian được chọn
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' .$avatar_name;
                            
                // đảm bảo file up lên là hình ảnh
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.' , $avatar_name);
                $extention = end($extention);
                if(in_array($extention, $allowed_files)){
                    //đảm bảo kích thước tệp hình ảnh ko quá lớn
                    if($avatar['size'] < 1000000){
                        //up ảnh
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);                                                                                                                                 
                    }else{
                        $_SESSION['signup'] = 'Kích thước tệp quá lớn. Nên nhỏ hơn 1mb';
                    }
                }else{
                    $_SESSION['signup'] = 'Tệp hình ảnh phải là định dạng jpg, png hoặc jpeg';
                }
            }
        } 
    }
        // quay lại trang đăng kí nếu có lỗi
        if(isset($_SESSION['signup'])){
            // chuyển dữ liệu trở lại trang đki
            $_SESSION['signup-data']=$_POST;
            header('location: ' . ROOT_URL . 'signup.php');
            die();
        }else{
            // chèn user vào bảng user
            $insert_user_query= "INSERT INTO users SET firstname='$firstname' , lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0 ";
            $insert_user_result = mysqli_query($connection, $insert_user_query);
            if(!mysqli_error($connection)){
            
            //chuyển hướng để đăng nhập
            $_SESSION['signup-success'] = "Đăng kí thành công!";
            header('location: ' . ROOT_URL . 'signup.php');
            die();
            
        }

    }

} else {
    //nếu nút ko được nhấn thì trả lại form đăng kí
    header('location:' . ROOT_URL .'signup.php');
    die(); 
}