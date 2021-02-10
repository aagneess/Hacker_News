<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// var_dump($_SESSION['replyCommentId']);
// var_dump($_POST);

if (isset($_POST['reply'], $_POST['comment-id'])) {
    $commentId = trim(filter_var($_POST['comment-id'], FILTER_SANITIZE_NUMBER_INT));
    $reply = trim(filter_var($_POST['reply'], FILTER_SANITIZE_STRING));
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $replyCreated = date('y-m-d h:m:s');

    $statement = $pdo->prepare('INSERT INTO replys 
        (comment_id, user_id, reply, reply_created, username) 
        VALUES (:comment_id, :user_id, :reply, :reply_created, :username)');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':reply', $reply, PDO::PARAM_STR);
    $statement->bindParam(':reply_created', $replyCreated, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $statement->execute();

    $_SESSION['message'] = 'You have now replied.';
    redirect('/');
}
