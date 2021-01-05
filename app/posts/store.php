<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.
if (isset($_POST['title'], $_POST['url'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $url = trim(filter_var($_POST['url'], FILTER_SANITIZE_URL));

    if (urlExists($url, $pdo)) {
        $_SESSION['message'] = 'Sorry, someone has already posted this link!';
        redirect('/../usernavigation/post.php');
    }
}

// Database
$query = 'INSERT INTO posts (title, url) VALUES (:title, :url)';
$statement = $pdo->prepare($query);
//Error info
if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}

// Prepare, bind email parameter and execute the database query.
$statement->bindParam(':title', $title, PDO::PARAM_STR);
$statement->bindParam(':url', $url, PDO::PARAM_STR);
$statement->execute();

// $_SESSION['message'] = 'You have successfully created a post!';

// redirect('/../index.php');

redirect('/');
