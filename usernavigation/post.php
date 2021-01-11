<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>


<h2>Create new post</h2>

<?php
$user = getUserId($_SESSION['user']['id'], $pdo);
$id = (int) $_SESSION['user']['id'];
?>
<form action="/../app/posts/store.php" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="title" name="title" id="title" placeholder="Title" value="" required>
    </div>

    <div class="form-group">
        <label for="url">Link</label>
        <input class="form-control" type="url" name="url" id="url" placeholder="https://..." required>
    </div>

    <div class="form-group">
        <label for="text_content">Write a Short Description!</label>
        <textarea class="form-control" type="text_content" name="text_content" id="text_content" placeholder="..." required></textarea>
    </div>

    <button type="submit" name="submit-post" class="btn btn-info">Submit</button>
</form>



<?php require __DIR__ . '/../views/footer.php'; ?>