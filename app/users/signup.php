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
    $query = "INSERT INTO users (username, email, password) VALUES (:username, :email,  :password)";
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'You have successfully created an account!';

    // ADD WHEN DEFAULT BIO AND AVATAR IS SET!
    // $statement = $pdo->prepare('INSERT INTO users (username, email, password, avatar, bio) VALUES (:username, :email,  :password, :avatar, :bio');
    // $statement->bindParam(':username', $username, PDO::PARAM_STR);
    // $statement->bindParam(':email', $email, PDO::PARAM_STR);
    // $statement->bindParam(':password', $password, PDO::PARAM_STR);
    // $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    // $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    // $statement->execute();

    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    // $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    // $statement->bindParam(':email', $email, PDO::PARAM_STR);
    // $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    // $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->execute();

    $registeredUser =  $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['userLoggedIn'] = [
        'user_id' => $registeredUser['id'],
        'username' => $registeredUser['username'],
        'email' => $registeredUser['email'],
        'avatar' => $registeredUser['avatar'],
        'bio' => $registeredUser['bio']
    ];


    redirect('/login.php');
};

redirect('/signup.php');
