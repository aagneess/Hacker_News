<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php
$id = (int) $_SESSION['user']['id'];
$userComments = getUserComments($pdo, $id);

?>

<h2>Want to make changes to your comments?</h2>

<section class="user-comments">
    <?php foreach ($userComments as $comment) : ?>

        <form action="/app/comments/update.php" method="post" class="change-comment">

            <input type="text" class="form-control" id="comment" name="comment" placeholder="<?= $comment['text_content'] ?>"></input>
            <br>
            <small class="form-text text-muted">User:<?= $comment['username'] ?> | Posted: <?= $comment['date_created']; ?></small>
            <button class="btn btn-info d-inline" type="submit" name="sumbit" value="submit">Update Comment</button>

        </form>

        <form action="/app/comments/delete.php" method="post" class="d-inline">
            <input type="hidden" id="post-id" name="post-title" value="<?= $comment['post_id']; ?>"></input>
            <button class="btn btn-danger d-inline" type="submit" name="submit" value="submit">Delete Comment</button>

        </form>

    <?php endforeach; ?>
</section>

<?php require __DIR__ . '/../views/footer.php'; ?>