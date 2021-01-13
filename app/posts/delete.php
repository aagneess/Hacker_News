<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete posts in the database.
if (isset($_POST['post-id'])) {
    $userId = (int) $_SESSION['user']['id'];
    $postId = $_POST['post-id'];

    $statement = $pdo->prepare('DELETE FROM posts WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    if ($statement) {
        $_SESSION['message'] = 'You have successfully deleted the post!';
    }
}
redirect('/usernavigation/userposts.php');
