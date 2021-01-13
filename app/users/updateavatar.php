<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    $file = $_FILES['avatar'];
    $newFile = $file['name'];
    $username = $_SESSION['user']['username'];
    $fileName = $username . '-' . $newFile;

    $allowedFileTypes = ['image/png', 'image/jpg', 'image/jpeg'];

    $statement = $pdo->prepare('UPDATE users 
    SET avatar = :avatar WHERE id = :id');
    $statement->bindParam(':avatar', $fileName, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    if (!in_array($file['type'], $allowedFileTypes)) {
        $_SESSION['message'] = 'The image file type is not allowed, please try again.';
        redirect('/usernavigation/accountsettings.php');
    } elseif ($file['size'] > 2097152) {
        $_SESSION['message'] = "The uploaded file exceeded the filesize limit.";
        redirect('//usernavigation/accountsettings.php');
    }
    if ($statement) {
        $destination = __DIR__ . "/uploads/$fileName";
        move_uploaded_file($file['tmp_name'], $destination);
    }
}






redirect('/../usernavigation/accountsettings.php');
