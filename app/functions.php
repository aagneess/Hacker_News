<?php

declare(strict_types=1);

// Redirect the user
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// Check if the username is already in use
function usernameExists(string $username, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return true;
    }

    return false;
}
// Check if the email is already in use
function emailExists(string $email, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return true;
    }

    return false;
}

// Verify that the user is logged in
function userIsLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

// Verify the user id
function userIdVerify($user): bool
{
    if ($_SESSION['user']['id'] === $user['id']) {
        return true;
    } else {
        return false;
    }
}

// POSTS

function urlExists(string $url, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE url = :url');
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->execute();

    $url = $statement->fetch(PDO::FETCH_ASSOC);

    if ($url) {
        return true;
    }

    return false;
}
