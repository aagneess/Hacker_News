<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store the upvotes.
if (isset($_SESSION['user']['id'])) {
    if (isset($_POST)) {
        $postId = $_POST['post-id'];
        $userId = $_SESSION['user']['id'];

        $statement = $pdo->prepare('SELECT * FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $upvoteExists = $statement->fetch();

        if (!$upvoteExists) {
            $statement = $pdo->prepare('INSERT INTO upvotes (post_id, user_id) VALUES (:post_id, :user_id)');
            $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        } else {
            $statement = $pdo->prepare('DELETE FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');
            $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
            $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }
    }
    $votes = numberOfUpvotes($pdo, $postId);
}

header("Content-Type: application/json");
echo json_encode($votes);
