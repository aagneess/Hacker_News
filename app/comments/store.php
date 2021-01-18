<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {
    if (isset($_POST['comment'])) {

        $postId = $_POST['post-id'];
        $userId = (int) $_SESSION['user']['id'];
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
        $commentCreated = date('y-m-d h:m:s');
        $username = $_SESSION['user']['username'];

        $statement = $pdo->prepare('INSERT INTO comments 
        (post_id, user_id, comment, comment_created, username) 
        VALUES (:post_id, :user_id, :comment, :comment_created, :username)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
        $statement->bindParam(':comment_created', $commentCreated, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        $statement->execute();

        $_SESSION['message'] = 'You have now left a comment.';
        redirect('/comments.php?postId=' . $postId);
    }
} else {
    $_SESSION['message'] = 'You need to log in to leave a comment.';
    redirect('/login.php');
}
