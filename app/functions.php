<?php

declare(strict_types=1);

// Redirect the user
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// SIGNUP
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

// Validate email address
function validateEmail(string $email): bool
{
    $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($isValid) {
        return true;
    } else {
        return false;
    }
}

// Validate content

function validateUrl(string $url, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE url = :url');
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->execute();

    $url = $statement->fetch(PDO::FETCH_ASSOC);

    if ($url) {
        return true;
    } else {
        return false;
    }
}


// PROFILE
// Function to get user info
function getUserById($pdo, $id)
{

    $statement = $pdo->prepare("SELECT id, username, email, avatar, bio FROM users WHERE id = :id");
    $statement->BindParam(':username', $id, PDO::PARAM_STR);
    $statement->execute();

    $user =  $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}
// ACCOUNT SETTINGS
function getUserId(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([':id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return $user;
    }
}
