<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php
$id = (int) $_SESSION['user']['id'];
$userPosts = userPosts($id, $pdo);
?>

<h2>Want to edit a post?</h2>

<section class="user-posts">
    <?php foreach ($userPosts as $post) : ?>

        <form action="/../app/users/updateposts.php" method="post" class="change-post">
            <label class="d-inline" for="post-title">Title:</label>
            <input type="text" class="form-control" id="post-title" name="post-title" placeholder="<?= $post['title'] ?>"></input>
            <br>
            <label for="post-title">Url:</label>
            <input type="url" class="form-control" id="post-link" name="post-link" placeholder="<?= $post['url'] ?>"></input>
            <br>
            <label for="post-title">Description:</label>
            <input type="text" class="form-control" id="text-content" name="text-content" placeholder="<?= $post['text_content'] ?>"></input>
            <br>
            <small class="form-text text-muted">User:<?= $post['username'] ?> | Posted: <?= $post['date_created']; ?></small>
            <small class="form-text text-muted">

                <button class="btn btn-info d-inline" type="submit" name="sumbit" value="submit">Update Post</button>
                <button class="btn btn-danger d-inline " type="submit" name="sumbit" value="submit">Delete Post</button>
        </form>
    <?php endforeach; ?>
</section>
<?php require __DIR__ . '/../views/footer.php'; ?>