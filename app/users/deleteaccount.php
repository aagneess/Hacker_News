<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['delete'])) {
    $username = $_SESSION['user']['username'];
    $user_id = $_SESSION['user']['id'];

    //Removing account of the user
    $statement = $pdo->prepare('DELETE FROM users WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    //Removing posts by the user
    $statement = $pdo->prepare('DELETE FROM posts WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    //Removing comments by the user
    $statement = $pdo->prepare('DELETE FROM comments WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    //Removing upvotes
    $statement = $pdo->prepare('DELETE FROM upvotes WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    //Removing replies
    $statement = $pdo->prepare('DELETE FROM replys WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    //Removing login sessions
    unset($_SESSION['userLoggedIn']);
    unset($_SESSION['user']);
    redirect('/');
}

redirect('/');
