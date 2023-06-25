<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $user_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE author_id = $user_id AND is_published = 1 ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
    $num_publish_posts = mysqli_num_rows($posts);
    $author_query = "SELECT * FROM users WHERE id = $user_id";
    $author_result = mysqli_query($connection, $author_query);
    $author = mysqli_fetch_assoc($author_result);
} else {
    header('location:' . ROOT_URL . 'blog.php');
    die();
}
?>

<section class="user_profile">
    <div class="container">
        <div class="user_info">
            <div class="user_info-avatar">
                <img src="./images/<?= $author['avatar'] ?>">
            </div>
            <div class="user_info-introduce">
                <h1><?= "{$author['firstname']} {$author['lastname']}" ?></h1>
                <small>
                    Email: <?= $author['email'] ?>
                </small>
                <small>
                    Publish post count: <?= $num_publish_posts ?>
                </small>
            </div>
        </div>
    </div>
</section>

<section class="posts section__extra-margin">
    <div class="container user_profile__list_post_header">
        <h2>List Publish Posts</h2>
    </div>
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                    <?php
                    // fetch category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category  = mysqli_fetch_assoc($category_result);

                    ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                        <?= substr($post['body'], 0, 150) ?>...
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <a href="<?= ROOT_URL ?>profiles.php?id=<?= $author['id'] ?>"><h5>By:<?= "{$author['firstname']} {$author['lastname']}" ?></h5></a>
                            <small>
                                <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>
<?php
include 'partials/footer.php'
?>
