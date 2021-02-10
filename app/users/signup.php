<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (emailExists($email, $pdo)) {
        $_SESSION['message'] = 'This email is already in use.';
        redirect('/signup.php');
    }

    if (usernameExists($username, $pdo)) {
        $_SESSION['message'] = 'This username is already in use.';
        redirect('/signup.php');
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['message'] = 'The passwords did not match, please try again.';
        redirect('/signup.php');
    }

    // Prepare, bind email parameter and execute the database query.
    $statement = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'You have successfully created an account!';

    redirect('/login.php');
};

redirect('/signup.php');
