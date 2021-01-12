<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update the users avatar.
if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $destination = __DIR__ . '/uploads/';
    $path = $_FILES['avatar']['name'];
    $fileType = pathinfo($path, PATHINFO_EXTENSION);
    $date = date('ymd');
    $newFile = $date . '-' . $username . '.' . $fileType;

    if ($avatar['size'] > 2097152) {
        $_SESSION['message'] = 'The uploaded file exceeded the file size limit, please try again!';
        redirect('/../usernavigation/accountsettings.php');
    }
    if ($fileType !== 'image/png' && $fileType !== 'image/jpg' && $fileType !== 'image/jpeg') {
        $_SESSION['message'] = 'This file type is not allowed, please try again!';
        redirect('/../usernavigation/accountsettings.php');
    } else {

        filter_var($avatar['name'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':avatar', $updateAvatar, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();


        move_uploaded_file($avatar['tmp_name'], $destination . $newAvatar);

        $_SESSION['message'] = 'You have successfully uploaded a new profile picture!';
        $_SESSION['user']['avatar'] = $newFile;
        redirect('/../usernavigation/accountsettings.php');
        // $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');

        //     if (!$statement) {
        //         die(var_dump($pdo->errorInfo()));
        //     }

        //     $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        //     $statement->bindParam(':id', $id, PDO::PARAM_INT);
        //     $statement->execute();

        //     move_uploaded_file($newFile, $destination);
        // }
        // if ($statement) {
        //     $_SESSION['message'] = 'You have successfully uploaded a new profile picture!';
        // }


    }
    redirect('/../usernavigation/accountsettings.php');
}
