<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete comments in the database.
if (isset($_POST['delete-comment'])) {
    $userId = (int) $_SESSION['user']['id'];
    $commentId = (int) $_POST['delete-comment'];
    //$id = $_GET['id'];

    //die(var_dump($postId));

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

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
redirect('/usernavigation/usercomments.php');
