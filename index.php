<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<h1>Top Posts</h1>

<?php
$upvotes = numberOfUpvotes($post['id'], $pdo);

$userPosts = allUserPosts($pdo);
foreach ($userPosts as $post) : ?>


    <section class="all-posts">
        <small class="form-text text-muted">Upvotes: <?php echo $upvotes; ?></small>

        <span class="votes">
            <form action="/../app/upvotes/store.php" method="post" class="upvote">
                <button class="btn btn-light" type="submit" name="sumbit" value="<?= $post['id'] ?>">↑ </button>
            </form>

            <form action="/../app/upvotes/delete.php" method="post" class="downvote">
                <button class="btn btn-light" type="submit" name="sumbit" value="<?= $post['id'] ?>"> ↓</button>
            </form>
        </span>

        <span class="post-title" id="post-title" name="post-title"><?= $post['title'] ?> (<a class="post-link" href="<?= $post['url'] ?>"><?= $post['url'] ?></a>)</span>
        <p><?= $post['text_content'] ?></p>
        <small class="form-text text-muted">User: <?= $post['username'] ?> | Posted: <?= $post['date_created']; ?></small>
        <br>

        <div class="comment-section">
            <form action="/../app/comments/store.php" method="post" class="comment">
                <input type="text" class="form-control" id="comment" name="comment" placeholder="..."></input>
                <button class="btn btn-info" type="submit" name="sumbit" value="<?= $post['id'] ?>">Comment</button>
            </form>
        </div>

    </section>


<?php endforeach; ?>



<?php require __DIR__ . '/views/footer.php'; ?>