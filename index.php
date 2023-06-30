<?php
include 'partials/header.php';

// fetch featured from database
$featured_query = "SELECT * FROM posts WHERE is_featured = 1 AND is_published = 1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

//fetch 9 pots from posts table
$query = "SELECT * FROM posts WHERE is_published = 1 ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);
?>


<!-- show featured posts if there's any  -->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="post__info">
                <?php
                // fetch category from categories table using category_id of post
                $category_id = $featured['category_id'];
                if (!is_null($category_id)) {
                    $category_query = "SELECT * FROM categories WHERE id = $category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category  = mysqli_fetch_assoc($category_result);
                }

                ?>
                <?php if (!is_null($category_id)) : ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                <?php else : ?>
                    <div class="category__button">Uncategory</div>
                <?php endif; ?>
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['body'], 0, 300) ?>...
                </p>
                <div class="post__author">
                    <?php
                    // fetch author from users table using author_id
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id = $author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);

                    ?>
                    <div class="post__author-avatar">
                        <img src="./images/<?= $author['avatar'] ?>">
                    </div>
                    <div class="post__author-info">
                        <a href="<?= ROOT_URL ?>profiles.php?id=<?= $author['id'] ?>">
                            <h5>By:<?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                        </a>
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
<!--============END of Fatured===============-->

<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
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
                    if (!is_null($category_id)) {
                        $category_query = "SELECT * FROM categories WHERE id = $category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category  = mysqli_fetch_assoc($category_result);
                    }
                    ?>
                    <?php if (is_null($category_id)) : ?>
                        <div class="category__button">Uncategory</div>
                    <?php else : ?>
                        <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <?php endif; ?>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                        <?= substr($post['body'], 0, 150) ?>...
                    </p>
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
                            <a href="<?= ROOT_URL ?>profiles.php?id=<?= $author['id'] ?>">
                                <h5>By:<?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            </a>
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
<!--==========================END OF POSTS====================================-->
<section class="category__button">
    <div class="container category__button-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!--==========================END OF CB====================================-->


<?php
include 'partials/footer.php';

?>