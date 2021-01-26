<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$postId = $_POST['post-id'];
$postTitle = trim(filter_var($_POST['post-title'], FILTER_SANITIZE_STRING));
$postLink = trim(filter_var($_POST['post-link'], FILTER_SANITIZE_URL));
$postContent = filter_var($_POST['text-content'], FILTER_SANITIZE_STRING);

// In this file we update the users posts.
if (isset($_POST['post-title'])) {

    $statement = $pdo->prepare('UPDATE posts SET 
    title = :title WHERE id = :id');
    $statement->bindParam(':id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':title', $postTitle, PDO::PARAM_STR);
    $statement->execute();

    if ($statement) {
        $_SESSION['message'] = 'You have successfully updated your post!';
    }
}

if (isset($_POST['post-link'])) {
    $statement = $pdo->prepare('UPDATE posts SET 
    url = :url WHERE id = :id');
    $statement->bindParam(':id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':url', $postLink, PDO::PARAM_STR);
    $statement->execute();

    if ($statement) {
        $_SESSION['message'] = 'You have successfully updated your post!';
    }
}

if (isset($_POST['text-content'])) {
    $statement = $pdo->prepare('UPDATE posts SET 
    text_content = :text_content WHERE id = :id');
    $statement->bindParam(':id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':text_content', $postContent, PDO::PARAM_STR);
    $statement->execute();

    if ($statement) {
        $_SESSION['message'] = 'You have successfully updated your post!';
    }
}

redirect('/usernavigation/userposts.php');
