<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get from data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['add-category'] ="Nhập tiêu đề";
    } elseif(!$description){
        $_SESSION['add-category'] ="Nhập mô tả";
    }    

    if (isset($_SESSION['add-category'])){
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    } else {
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['add-category'] = "Không thể thêm tiêu đề";
            header('Location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            $_SESSION['add-category-success'] = " danh mục $title được thêm thành công";
            header('Location: ' . ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
}  
