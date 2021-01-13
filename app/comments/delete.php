<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete posts in the database.
if (isset($_POST['comment-id'])) {
    $userId = (int) $_SESSION['user']['id'];
    $postId = (int) $_POST['comment-id'];
    $id = $_GET['id'];

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :post_id AND user_id = :user_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userOd, PDO::PARAM_INT);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute();

    if ($statement) {
        $_SESSION['message'] = 'You have successfully deleted the comment!';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
    }
}
redirect('/../usernavigation/usercomments.php');
