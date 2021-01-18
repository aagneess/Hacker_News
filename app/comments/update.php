<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update comments in the database.
if (isset($_POST['comment-id'])) {

    $commentId = $_POST['comment-id'];
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('UPDATE comments SET 
    comment = :comment WHERE id = :id');
    $statement->bindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':comment', $comment, PDO::PARAM_STR);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute();

    if ($statement) {
        $_SESSION['message'] = 'You have successfully updated your comment!';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
    }
}
redirect('/usernavigation/usercomments.php');
