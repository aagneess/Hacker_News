<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<h1>Top Posts</h1>
<?php
// $upvotes = numberOfUpvotes($post['id'], $pdo);
// <small class="form-text text-muted">Upvotes: <?php echo $upvotes; <small class="form-text text-muted">Upvotes: </small>

// <form action="/../app/upvotes/delete.php" method="post" class="downvote">
// <button class="btn btn-light d-inline" type="submit" name="sumbit" value="<?= $post['id']
// "> ↓</button>
// </form>

$userPosts = allUserPosts($pdo);
?>

<?php foreach ($userPosts as $post) :
    $postId = $post['id'];
    $comments = countComments($pdo, $postId);
?>

    <section class="all-posts" id="<?= $post['id']; ?>">

        <div class="votes">
            <small class="form-text text-muted">Upvotes: </small>

            <?php if (isset($_SESSION['user']) && createUpvote($pdo, $_SESSION['user']['id'], $post['id'])) : ?>
                <button class="vote active" data-post="<?= $post['id'] ?>">↑ </button>

            <?php elseif (isset($_SESSION['user']) && !createUpvote($pdo, $_SESSION['user']['id'], $post['id'])) : ?>
                <button class="vote inactive" data-post="<?= $post['id'] ?>">↑ </button>
            <?php else : ?>
                <button class="vote" data-post="<?= $post['id'] ?>">↑ </button>
            <?php endif; ?>
        </div>

        <p class="post-title" id="post-title" name="post-title"><?= $post['title'] ?></p>
        <a class="d-inline-block text-truncate text-justify text-info lead font-weight-light text-decoration-none" style="max-width: 200px" href="<?= $post['url'] ?>"> <?= $post['url'] ?> </a>
        <p class="font-weight-light"><?= $post['text_content'] ?></p>
        <a class="lead text-info text-decoration-none" href="comments.php?postId=<?= $post['id'] ?>">Comments (<?= $comments ?>)</a>

        <small class="form-text text-muted">
            <span class="badge badge-pill badge-secondary">User: </span>
            <a class="text-info text-decoration-none" href="/profiles.php?userId=<?= $post['user_id'] ?>"><?= $post['username'] ?> </a>
            <span class="badge badge-pill badge-secondary">Posted: </span>
            <?= $post['date_created']; ?>
        </small>


    </section>


<?php endforeach; ?>




<?php require __DIR__ . '/views/footer.php'; ?>