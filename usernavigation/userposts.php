<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php
$id = (int) $_SESSION['user']['id'];
$userPosts = getUserPosts($pdo, $id);

//die(var_dump($userPosts));
?>

<h2>Want to edit a post?</h2>
<?php foreach ($userPosts as $post) : ?>

    <section class="user-posts">
        <form action="/app/posts/update.php" method="post" class="form">
            <label for="post-title">Title:</label>
            <input type="text" class="form-control" id="post-title" name="post-title" placeholder="<?= $post['title'] ?>"></input>
            <br>
            <label for="post-title">Url:</label>
            <input type="url" class="form-control" id="post-link" name="post-link" placeholder="<?= $post['url'] ?>"></input>
            <br>
            <label for="post-title">Description:</label>
            <input type="text" class="form-control" id="text-content" name="text-content" placeholder="<?= $post['text_content'] ?>"></input>
            <br>
            <small class="form-text text-muted">User:<?= $post['username'] ?> | Posted: <?= $post['date_created']; ?></small>
            <br>
            <div class="btn-group " role="group">
                <button class="rounded btn btn-info" type="post-id" name="post-id" value="<?= $post['id']; ?>">Update Post</button>
        </form>

        <form action="/app/posts/delete.php" method="post" class="form">
            <button class="ml-1 btn btn-danger" type="post-id" name="post-id" value="<?= $post['id']; ?>">Delete Post</button>
            </div>
        </form>

    </section>

<?php endforeach; ?>
<?php require __DIR__ . '/../views/footer.php'; ?>