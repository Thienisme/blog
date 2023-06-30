<?php
include 'partials/header.php';

// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id =$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    // Fetch comments for the post
    $comments_query = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at DESC";
    $comments_result = mysqli_query($connection, $comments_query);

    // Check if the user is logged in
    $current_user_id = isset($_SESSION['user-id']) ? $_SESSION['user-id'] : null;
    if ($current_user_id) {
        $current_user_query = "SELECT * FROM users WHERE id = $current_user_id";
        $current_user_result = mysqli_query($connection, $current_user_query);
        $current_user = mysqli_fetch_assoc($current_user_result);
    }
} else {
    header('location:' . ROOT_URL . 'blog.php');
    die();
}
?>

<section class="singlepost">
    <div class="container singlepost__container">
        <?php if (isset($_SESSION['delete-comment-success'])) : ?>
            <div class="alert__message success">
                <p>
                    <?=
                    $_SESSION['delete-comment-success'];
                    unset($_SESSION['delete-comment-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <h2><?= $post['title'] ?></h2>
        <div class="post__author">
            <?php
            // fetch author from users table using author_id
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id = $author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);

            ?>
            <div class="post__author-avatar">
                <img src="./images/<?= $author['avatar'] ?>">
            </div>
            <div class="post__author-info">
                <h5>By:<?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>
        </div>
        <div class="singlepost__thumbnail">
            <img src="./images/<?= $post['thumbnail'] ?>">
        </div>
        <b>
            <?= $post['body'] ?>
        </b>

        <div class="comment-section">
            <div class="post-comment">
                <?php
                // Kiểm tra và hiển thị các comment
                if (mysqli_num_rows($comments_result) > 0) {
                    while ($comment = mysqli_fetch_assoc($comments_result)) {
                        $author_comment = $comment['author'];
                        $author_comment_query = "SELECT * FROM users WHERE id = $author_comment";
                        $author_comment_result = mysqli_query($connection, $author_comment_query);
                        $author_comment = mysqli_fetch_assoc($author_comment_result);
                        $format_created_at = date('F d, Y H:i', strtotime($comment['created_at']));
                        $root_url = ROOT_URL;

                        $can_delete_comment = $author_comment['id'] == $current_user_id;
                        if ($can_delete_comment) {
                            echo <<<HTML
                            <div class="list">
                                <div class="user">
                                    <div class="info">
                                        <div class="user-img"><img src="./images/{$author_comment['avatar']}" alt="image"></div>
                                        <div class="user-meta">
                                            <div class="name">{$author_comment['firstname']}</div>
                                            <div class="day">{$format_created_at}</div>
                                        </div>
                                    </div>
                                    <div class="delete-comment">
                                        <form action="{$root_url}delete-comment.php" enctype="multipart/form-data" method = "DELETE">
                                            <input type="hidden" name="post_id" value="{$comment['post_id']}">
                                            <input type="hidden" name="comment_id" value="{$comment['id']}">
                                            <button type="submit" name="submit" class="delete-comment-button">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="comment-post">{$comment['content']}</div>
                            </div>
                            HTML;
                        } else {
                            echo <<<HTML
                            <div class="list">
                                <div class="user">
                                    <div class="info">
                                        <div class="user-img"><img src="./images/{$author_comment['avatar']}" alt="image"></div>
                                        <div class="user-meta">
                                            <div class="name">{$author_comment['firstname']}</div>
                                            <div class="day">{$format_created_at}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-post">{$comment['content']}</div>
                            </div>
                            HTML;
                        }
                    }
                } else {
                    echo '<p>Chưa có bình luận nào.</p>';
                }
                ?>
            </div>
            <?php if ($current_user_id) : ?>
                <div class="comment-box">
                <div class="user">
                    <div class="post__author-avatar">
                        <img src="./images/<?= $current_user['avatar'] ?>">
                    </div>
                    <div class="post__author-info">
                        <h5>By:<?= "{$current_user['firstname']} {$current_user['lastname']}" ?></h5>
                    </div>
                </div>
                <form action="<?= ROOT_URL ?>post_comment.php" enctype="multipart/form-data" method="POST">
                    <!-- <form action="post_comment.php" method="post"> -->
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <div class="comment-input">
                        <textarea name="content" placeholder="Your comment"></textarea>
                    </div>
                    <button type="submit" name="submit" class="comment-submit">Submit</button>
                </form>
            </div>
            <?php else : ?>
                <p>Vui lòng đăng nhập để bình luận.</p>
            <?php endif ?>
        </div>
    </div>
</section>
<?php
include 'partials/footer.php'
?>
