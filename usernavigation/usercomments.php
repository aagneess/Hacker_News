<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php

// Get post related to each user's comments
// $statement = $pdo->prepare('SELECT posts.*, comments.post_id
//     FROM posts
//     INNER JOIN comments
//     ON posts.id = comments.post_id');
// $statement->execute();
// $post = $statement->fetchAll(PDO::FETCH_ASSOC);
//die(var_dump($post));

$id = (int) $_SESSION['user']['id'];
$userComments = getUserComments($pdo, $id);
?>

<h2>Want to make changes to your comments?</h2>

<?php foreach ($userComments as $comment) : ?>
    <section class="user-comments">

        <form action="/app/comments/update.php" method="post" class="change-comment">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="<?= $comment['comment'] ?>"></input>
            <small class="form-text text-muted">Posted: <?= $comment['comment_created']; ?></small>
            <input type="hidden" id="comment-id" name="comment-id" value="<?= $comment['id']; ?>"></input>

            <div class="btn-group " role="group">
                <button class="rounded btn btn-info" type="submit" name="sumbit" value="submit">Update Comment</button>
        </form>

        <form action="/app/comments/delete.php" method="post">
            <input type="hidden" id="delete-comment" name="delete-comment" value="<?= $comment['id']; ?>"></input>
            <button class="ml-1 btn btn-danger" type="submit" name="submit" value="submit">Delete Comment</button>
        </form>
        </div><br>

    <?php endforeach; ?>
    </section>

    <?php require __DIR__ . '/../views/footer.php'; ?>