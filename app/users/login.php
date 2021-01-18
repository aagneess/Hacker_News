<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Check if both email and password exists in the POST request.
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    // Prepare, bind email parameter and execute the database query.
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['message'] = 'There is no account linked to this email address, please try again.';
        redirect('/login.php');
    }

    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
    } else {
        $_SESSION['message'] = 'The password is not linked to the provided email address, please try again.';
        redirect('/login.php');
    }
}

if (isset($user['password']) && password_verify($password, $user['password'])) {
    $_SESSION['userLoggedIn'] = [
        'user_id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'avatar' => $user['avatar'],
        'bio' => $user['bio']
    ];
}

redirect('/');
