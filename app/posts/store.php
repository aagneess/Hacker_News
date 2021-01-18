<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.
if (isset($_POST['title'], $_POST['url'], $_POST['text_content'])) {

    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $url = trim(filter_var($_POST['url'], FILTER_SANITIZE_URL));
    $textContent = trim(filter_var($_POST['text_content'], FILTER_SANITIZE_STRING));
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $dateCreated = date('y-m-d h:m:s');

    $createPost = 'INSERT INTO posts (title, url, text_content, user_id, username, date_created) 
    VALUES (:title, :url, :text_content, :user_id, :username, :date_created)';
    $statement = $pdo->prepare($createPost);

    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->bindParam(':text_content', $textContent, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':date_created', $dateCreated, PDO::PARAM_STR);
    $statement->execute();

    if (!$statement) {
        die(var_dump($database->errorInfo()));
    }

    if (!$statement) {
        $_SESSION['message'] = 'Please fill in all forms!';
    } else {
        $_SESSION['message'] = 'You have successfully created a post!';
    }
}
redirect('/usernavigation/post.php');
