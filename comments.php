<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$postId = $_GET['postId'];
//die(var_dump($postId));
$post = getPostById($pdo, $postId);
$comments = getComments($pdo, $postId);
?>

<section class="posts" id="<?= $post['id'] ?>">
    <span class="post-title" id="post-title" name="post-title"><?= $post['title'] ?> (<a class="text-info text-decoration-none" href="<?= $post['url'] ?>"><?= $post['url'] ?></a>)</span>
    <p><?= $post['text_content'] ?></p>
    <small class="form-text text-muted">
        <span class="badge badge-pill badge-secondary">User: </span>
        <a class="text-info text-decoration-none" href="/profiles.php?userId=<?= $post['user_id'] ?>"><?= $post['username'] ?> </a>
        <span class="badge badge-pill badge-secondary">Posted: </span>
        <?= $post['date_created']; ?></small>
    <br>
</section>

<section class="comment-section">
    <p>Comments:</p>
    <?php foreach ($comments as $comment) : ?>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?= $comment['comment'] ?></li>
            <small class="form-text text-muted">User: <?= $comment['username'] ?> | Posted: <?= $comment['comment_created']; ?>
                <?php if (isset($_SESSION['user'])) : ?>
                    | <a href="reply.php?commentId=<?= $comment['id'] ?>">Reply</a>
                <?php endif; ?></small>
        </ul><br>
        <div class="replies">
            <?php $replies = getReplies($pdo, $comment['id']); ?>
            <?php foreach ($replies as $reply) : ?>
                <!-- <ul class="list-group list-group-flush"> -->
                <!-- <li class="list-group-item"></li> -->
                <p class="reply"><?= $reply['reply'] ?></p>
                <small class="form-text text-muted">User: <?= $reply['username'] ?> | Posted: <?= $reply['reply_created']; ?></small>
                </ul><br>
            <?php endforeach; ?>
        </div>
</section>

<?php endforeach; ?>

<section class="write-comment">
    <form action="/app/comments/store.php" method="post" class="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="..." aria-label="write a comment">
            <div class="input-group-append">
                <input type="hidden" class="form-control" id="post-id" name="post-id" value="<?= $post['id'] ?>"></input>
                <input type="hidden" class="form-control" id="comment-id" name="comment-id" value="<?= $comment['id'] ?>"></input>
                <button class="btn btn-outline-info" type="submit" name="sumbit" value="submit">Comment</button>
            </div>
        </div>
    </form>
</section>

<a class="text-info text-decoration-none" href="/">← Back</a>

<?php require __DIR__ . '/views/footer.php'; ?>