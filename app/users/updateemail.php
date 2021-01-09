<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update the users bio.
if (isset($_POST['email'])) {

    $updateEmail = trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('UPDATE users SET email = :updateEmail WHERE id = :id');
    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->BindParam(':updateEmail', $updateEmail, PDO::PARAM_STR);
    $statement->execute();

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    if ($updateEmail) {
        $_SESSION['message'] = 'You have successfully updated your email!';
    }
}

redirect('/../usernavigation/accountsettings.php');
