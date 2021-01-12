<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<h1>Recent Posts</h1>

<?php $userPosts = allUserPosts($pdo);
foreach ($userPosts as $post) : ?>

    <section class="all-posts">
        <span class="post-title" id="post-title" name="post-title"><?= $post['title'] ?> (<a class="post-link" href="<?= $post['url'] ?>"><?= $post['url'] ?></a>)</span>
        <p><?= $post['text_content'] ?></p>
        <small class="form-text text-muted">User: <?= $post['username'] ?> | Posted: <?= $post['date_created']; ?></small>
        <br>

        <div class="comment-section">
            <form action="/../app/comments/store.php" method="post" class="">
                <input type="text" class="form-control" id="comment" name="comment" placeholder="..."></input>
                <button class="btn btn-info" type="submit" name="sumbit" value="submit">Comment</button>
            </form>
        </div>

    </section>


<?php endforeach; ?>

<?php require __DIR__ . '/views/footer.php'; ?>