<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete upvotes.

if (isset($_POST['post-id'])) {
    $postId = $_POST['post-id'];
    $userId = (int) $_SESSION['user']['id'];

    $statement = $pdo->prepare('DELETE FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorinfo()));
    }

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();
}
