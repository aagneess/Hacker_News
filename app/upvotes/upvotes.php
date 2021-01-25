<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store the upvotes.
if (isset($_POST['post-id'])) {
    $postId = $_POST['post-id'];
    $userId = (int) $_SESSION['user']['id'];

    if (upvoteExists($pdo, $userId, $postId)) {
        removeUpvote($pdo, $userId, $postId);
    } else {
        addUpvote($pdo, $userId, $postId);
    }
} else {
    $_SESSION['message'] = 'You need to log in to upvote posts.';
    redirect('/index.php');
}



// if (isset($_SESSION['user'])) {
//     if (isset($_POST['post-id'])) {
//         $postId = $_POST['post-id'];
//         $userId = (int) $_SESSION['user']['id'];

//         if (upvoteExists($pdo, $userId, $postId)) {
//             removeUpvote($pdo, $userId, $postId);
//         } else {
//             addUpvote($pdo, $userId, $postId);
//         }
//     } else {
//         $_SESSION['message'] = 'You need to log in to upvote posts.';
//         redirect('/index.php');
//     }
// }
