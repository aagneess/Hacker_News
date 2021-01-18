<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    $id = $_SESSION['user']['id'];
    $file = $_FILES['avatar'];
    $newFile = date('ymd') . '-' . $file['name'];
    $destination = __DIR__ . 'uploads/' . $newFile;

    $statement = $pdo->prepare('UPDATE users 
    SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':avatar', $newFile, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    if ($file['size'] > 2097152) {
        $_SESSION['message'] = "The uploaded file exceeded the filesize limit.";
        redirect('/usernavigation/accountsettings.php');
    } else {
        move_uploaded_file($file['tmp_name'], $newFile);
        $_SESSION['message'] = "You've updated you profile picture!";
    }
}

redirect('/usernavigation/accountsettings.php');
