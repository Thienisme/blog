<?php
require '../partials/header.php';  
// kiểm tra trạng thái đăng nhập
if(!isset($_SESSION['user-id'])){
    header('location: '. ROOT_URL . 'signin.php');
    die();
}
?>
