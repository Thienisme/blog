<?php
include 'partials/header.php';
if (isset($_POST['submit'])) {
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    $post_content = filter_var($_POST['content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author = $_SESSION['user-id'];

    $insert_query = "INSERT INTO comments (post_id, content, author) VALUES ('$post_id', '$post_content', '$author')";
    if (mysqli_query($connection, $insert_query)) {
        // Lưu bình luận thành công, chuyển hướng trở lại bài đăng hiện tại để xem bình luận mới
        header("Location: post.php?id=$post_id");
        exit();
    } else {
        // Xử lý lỗi nếu truy vấn không thành công
        echo 'Error: ' . mysqli_error($connection);
    }
} else {
    header('location:' . ROOT_URL . 'blog.php');
    die();
}
?>

<?php include 'partials/footer.php' ?>
