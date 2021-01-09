<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update the users password.
if (isset($_POST['current-password'], $_POST['new-password'], $_POST['repeat-password'])) {

    $currentPassword = trim($_POST['current-password']);
    $newPassword = trim($_POST['new-password']);
    $repeatPassword = trim($_POST['repeat-password']);
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT password FROM users WHERE id = :id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($currentPassword, $user['password'])) {
        if ($newPassword == $repeatPassword) {
            $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $_SESSION['message'] = 'Your password is now updated!';
            $_SESSION['user']['password'] = $newPassword;
        } else {
            $_SESSION['message'] = 'The passwords do not match, please try again!';
        }
    } else {
        $_SESSION['message'] = 'You have typed the wrong password, please try again!';
    }
}

redirect('/../usernavigation/accountsettings.php');
