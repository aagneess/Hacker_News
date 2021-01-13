<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update the users posts.
if (isset($_POST)) {

    $postTitle = trim(filter_var($_POST['post-title'], FILTER_SANITIZE_STRING));
    $postLink = trim(filter_var($_POST['post-link'], FILTER_SANITIZE_URL));
    $postContent = filter_var($_POST['text-content'], FILTER_SANITIZE_STRING);
    $postId = $_POST['post-id'];

    $statement = $pdo->prepare('UPDATE posts SET 
    title = :title, url = :url, text_content = :text_content WHERE id = :id');
    $statement->bindParam(':title', $postTitle, PDO::PARAM_STR);
    $statement->bindParam(':url', $postLink, PDO::PARAM_STR);
    $statement->bindParam(':text_content', $postContent, PDO::PARAM_STR);
    $statement->bindParam(':id', $postId, PDO::PARAM_INT);

    $statement->execute();

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    if ($statement) {
        $_SESSION['message'] = 'You have successfully updated your post!';
    }
}

redirect('/usernavigation/userposts.php');
