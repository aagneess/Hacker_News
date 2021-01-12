<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['post-id'])) {
    $userId = (int) $_SESSION['user']['id'];
    // $postId = getPostById($id, $pdo);
    $postId = (int) $_POST['post-id'];

    $statement = $pdo->prepare('DELETE FROM posts WHERE id = :postId AND user_id = :userId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);


    $statement->execute();
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    if ($statement) {
        $_SESSION['message'] = 'You have successfully deleted the post!';
    }
}

redirect('/../usernavigation/userposts.php');
