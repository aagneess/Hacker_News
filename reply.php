<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$commentId = $_GET['commentId'];
$comment = getComment($pdo, $commentId);
$_SESSION['replyCommentId'] = $comment['id'];
?>

<section class="comment">
    <h2>Comment:</h2>
    <p><?= $comment['comment']; ?></p>
    <small class="form-text text-muted">
        <span class="badge badge-pill badge-secondary">User: </span>
        <a class="text-info text-decoration-none" href="/profiles.php?userId=<?= $comment['user_id'] ?>"><?= $comment['username'] ?> </a>
        <span class="badge badge-pill badge-secondary">Posted: </span>
        <?= $comment['comment_created']; ?></small>
    <br>
</section>





<section class="write-comment">
    <form action="/app/comments/reply.php" method="post" class="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="reply" name="reply" placeholder="..." aria-label="write a comment" required>
            <div class="input-group-append">
                <input type="hidden" class="form-control" id="comment-id" name="comment-id" value="<?= $comment['id'] ?>"></input>
                <button class="btn btn-outline-info" type="submit">Reply</button>
            </div>
        </div>
    </form>
</section>