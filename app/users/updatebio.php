<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update the users bio.
if (isset($_POST['bio'])) {

    $updateBio = trim(filter_var($_POST['bio'], FILTER_SANITIZE_STRING));
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('UPDATE users SET bio = :updateBio WHERE id = :id');
    $statement->BindParam(':id', $id, PDO::PARAM_INT);
    $statement->BindParam(':updateBio', $updateBio, PDO::PARAM_STR);
    $statement->execute();

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    if ($updateBio) {
        $_SESSION['message'] = 'You have successfully updated your bio!';
    }
}

redirect('/../usernavigation/accountsettings.php');
