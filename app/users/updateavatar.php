<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update the users avatar.
if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $newFile = date('ymd') . '-' . $avatar['name'];
    $destination = __DIR__ . '/../uploads/' . $newFile;

    if ($avatar['size'] > 2097152) {
        $_SESSION['message'] = 'The uploaded file exceeded the file size limit, please try again!';
    }
    if ($avatar['type'] !== 'image/png' && $avatar['type'] !== 'image/jpg' && $avatar['type'] !== 'image/jpeg') {
        $_SESSION['message'] = 'This file type is not allowed, please try again!';
    } else {
        $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        move_uploaded_file($newFile, $destination);
    }
    if ($statement) {
        $_SESSION['message'] = 'You have successfully uploaded a new profile picture!';
    }

    redirect('/../usernavigation/accountsettings.php');
}
