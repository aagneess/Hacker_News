<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<h1>Top Posts</h1>
<?php $mostUpvoted = mostUpvotedPosts($pdo); ?>

<?php foreach ($mostUpvoted as $post) :
    $postId = $post['id'];
    $comments = countComments($pdo, $postId);
    $upvotes = numberOfUpvotes($pdo, $postId);
?>

    <article class="all-posts">

        <section class="upvotes">
            <form action="/app/upvotes/upvotes.php" method="post">
                <?php if (isset($_SESSION['user'])) :
                    $userId = $_SESSION['user']['id']; ?>
                    <input type="hidden" class="form-control" id="post-id" name="post-id" value="<?= $post['id'] ?>"></input>
                    <button class="btn btn-sm btn-outline-secondary d-inline shadow-none" id="submit" name="submit">↑</button>
                <?php else : {
                    };
                endif; ?>
                <small class="form-text text-muted d-inline">Upvotes: <?= $upvotes ?></small>
            </form>


            <p class="post-title" id="post-title" name="post-title"><?= $post['title'] ?></p>
            <a class="d-inline-block text-truncate text-justify text-info lead font-weight-light text-decoration-none" style="max-width: 100%" href="<?= $post['url'] ?>"> <?= $post['url'] ?> </a>
            <p class="font-weight-light"><?= $post['text_content'] ?></p>
            <a class="lead text-info text-decoration-none" href="comments.php?postId=<?= $post['id'] ?>">Comments (<?= $comments ?>)</a>

            <small class="form-text text-muted">
                <span class="badge badge-pill badge-secondary">User: </span>
                <a class="text-info text-decoration-none" href="/profiles.php?userId=<?= $post['user_id'] ?>"><?= $post['username'] ?> </a>
                <span class="badge badge-pill badge-secondary">Posted: </span>
                <time><?= $post['date_created']; ?></time>
            </small>
        </section>

    </article>
<?php endforeach; ?>
<?php require __DIR__ . '/views/footer.php'; ?>