<?php
require 'config/database.php';

if(isset($_GET['comment_id'])) {
    $comment_id = filter_var($_GET['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    $post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM comments WHERE id=$comment_id";
    $result = mysqli_query($connection, $query);

    if ($author_comment['id'] == $current_user_id){

        $delete_comment_query = "DELETE FROM comments WHERE id=$comment_id AND post_id=$post_id LIMIT 1";
        $delete_comment_result = mysqli_query($connection, $delete_comment_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['delete-comment-success'] = "Xóa bình luận thành công";
            header("Location: post.php?id=$post_id");
            exit();
        }
    }
}

header('location:' . ROOT_URL . 'blog.php');
die();
