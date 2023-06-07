<?php
include 'partials/header.php';

?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Title">
            <select>
                <option value="1">Travel</option>
                <option value="2">Art</option>
                <option value="3">Travel</option>
                <option value="4">Travel</option>
                <option value="5">Travel</option>
                <option value="6">Travel</option>
            </select>
            <textarea rows="10" placeholder="Body"></textarea>
            <div class="form__control inline">
                <input type= "checkbox" id="is_featured">
                <label for="is_featured" checked>Featured</label>
            </div>
            <div class="form__control">
                <label for="Thumbnail">Change Thumbnail</label>
                <input type="file" id="thumbnail">
            </div>

            <button type="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>
<?php
include '../partials/footer.php';

?>