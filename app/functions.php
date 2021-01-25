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
function getUserById(object $pdo, int $id): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user =  $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

// ACCOUNT SETTINGS
function getUserId(object $pdo, int $id): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user =  $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

// THE USERS POSTS

// Get the user's post
function getUserPosts(object $pdo, int $id): array
{
    $statement = $pdo->prepare('SELECT * FROM posts
    WHERE user_id = :user_id
    ORDER BY id DESC');

    $statement->BindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$statement) {
        return $_SESSION['message'] = "You have not created any posts at this moment.";
    }

    return $userPosts;
}

// COMMENT SECTION
// Get post by id for comment section
function getPostById(object $pdo, int $postId): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $postId, PDO::PARAM_INT);
    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);
    if ($post) {
        return $post;
    }
}
function getCommentsByPostId(object $pdo, int $postId): array
{
    $statement = $pdo->prepare('SELECT * FROM comments
    WHERE comment_post_id = :post_id
    ORDER BY comment_created DESC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}
// Count comments
function countComments(object $pdo, int $postId): int
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM comments WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();

    $numberOfComments = $statement->fetch(PDO::FETCH_ASSOC);
    return (int) $numberOfComments["COUNT(*)"];
}

// ALL USER POSTS (new posts ORIGINAL)
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

// COMMENTS BY POST

function getComments(object $pdo, int $postId): array
{
    $statement = $pdo->prepare('SELECT * FROM comments
    WHERE post_id = :post_id');

    $statement->BindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}
// Get one users comments
function getUserComments(object $pdo, int $id): array
{
    $statement = $pdo->prepare('SELECT * FROM comments
    WHERE user_id = :user_id
    ORDER BY comment_created DESC');

    $statement->BindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();

    $userComments = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$statement) {
        return $_SESSION['message'] = "You have not written any comments yet.";
    }

    return $userComments;
}

// Get post related to each user's comments
function postRelatedToComment(object $pdo, int $postId): array
{
    $statement = $pdo->prepare('SELECT posts.*, comments.post_id
    FROM posts
    INNER JOIN comments
    ON posts.id = comments.post_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $post;
}



// FUNCTIONS - UPVOTES
// Create upvote
function addUpvote(object $pdo, int $userId, int $postId)
{
    $statement = $pdo->prepare('INSERT INTO upvotes (post_id, user_id) VALUES (:post_id, :user_id)');
    $statement->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":post_id", $postId, PDO::PARAM_INT);
    $statement->execute();
}

// Delete upvote if already upvoted
function removeUpvote(object $pdo, int $userId, int $postId)
{
    $statement = $pdo->prepare('DELETE FROM upvotes WHERE user_id = :user_id AND post_id = :post_id');
    $statement->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $statement->bindParam(":post_id", $postId, PDO::PARAM_INT);
    $statement->execute();
}

function upvoteExists(object $pdo, int $userId, int $postId): bool
{
    $statement = $pdo->prepare('SELECT * FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $upvote = $statement->fetch(PDO::FETCH_ASSOC);

    if ($upvote) {
        return true;
    } else {
        return false;
    }
}

function numberOfUpvotes(object $pdo, int $postId): int
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM upvotes WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetch(PDO::FETCH_ASSOC);
    return (int) $upvotes["COUNT(*)"];
}
