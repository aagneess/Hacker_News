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
            <?php if (isset($_SESSION['user'])) : ?>

                <?php
                $userId = $_SESSION['user']['id'];

                $statement = $pdo->prepare('SELECT * FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');
                $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
                $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $statement->execute();
                $upvoteExists = $statement->fetch();
                ?>

                <form class="upvote" action="/app/upvotes/upvotes.php" method="post">
                    <input type="hidden" name="upvote" id="post-id" value="<?= $post['id']; ?>"></input>
                    <?php if ($upvoteExists) : ?>
                        <button class="upvote-button btn btn-sm btn-secondary d-inline shadow-none" data-id="<?= $post['id'] ?>" value="submit" type="submit">↑</button>
                    <?php else : ?>
                        <button class="upvote-button btn btn-sm btn-outline-secondary d-inline shadow-none" data-id="<?= $post['id'] ?>" value="submit" type="submit">↑</button>
                    <?php endif; ?>
                <?php else : {
                };
            endif; ?>

                <small class="form-text text-muted d-inline">Upvotes: <span data-id="<?= $post['id'] ?>" class="amount"><?= $upvotes ?></span></small>

                </form>

        </section>

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

    </article>


<?php endforeach; ?>
<?php require __DIR__ . '/views/footer.php'; ?>