<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

// In this file we store the upvotes.

if (isset($_POST['upvote'])) {
    $postId = $_POST['upvote'];
    $userId = $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT * FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $upvoteExists = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$upvoteExists) {
        $statement = $pdo->prepare('INSERT INTO upvotes (post_id, user_id) VALUES (:post_id, :user_id)');
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $amount = numberOfUpvotes($pdo, $postId);
        $response = ['amount' => $amount];

        echo json_encode($response);
    } else {
        $statement = $pdo->prepare('DELETE FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $amount = numberOfUpvotes($pdo, $postId);
        $response = ['amount' => $amount];

        echo json_encode($response);
    }
}
