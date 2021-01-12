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

// Validate url
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
function getUserById(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user =  $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}
// ACCOUNT SETTINGS
function getUserId(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([':id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return $user;
    }
}

// THE USERS POSTS

// Get the user's post
function getUserPosts(object $pdo, int $id): array
{
    $statement = $pdo->prepare('SELECT * FROM posts
    INNER JOIN users
    ON posts.user_id = users.id
    WHERE users.id = :id
    ORDER BY posts.id DESC');

    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$statement) {
        return $_SESSION['message'] = "You have not created any posts at this moment.";
    }

    return $userPosts;
}

//
function getPostById(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);
    if ($post) {
        return $post;
    }
}

// ALL USER POSTS (new posts)
function allUserPosts(object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts
    ORDER BY posts.date_created DESC');

    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $userPosts;
}
// ALL USER POSTS (older posts)
function allUserPostsAsc(object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts
    ORDER BY posts.date_created ASC');

    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $userPosts;
}
