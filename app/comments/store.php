<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['comment'])) {
    $postId = $_POST['id'];
    $userId = (int) $_SESSION['user']['id'];
    $textContent = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $dateCreated = date('y-m-d h:m:s');

    $statement = $pdo->prepare('INSERT INTO comments (post_id, user_id, text_content, date_created) VALUES (:post_id, :user_id, :text_content, :date_created)');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':text_content', $textContent, PDO::PARAM_STR);
    $statement->bindParam(':date_created', $dateCreated, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'You have now left a comment.';
    redirect('/index.php?id=' . $postId);
} else {
    $_SESSION['message'] = 'You need to log in to leave a comment.';
    redirect('/login.php');
}
