<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<article>
    <h1><?= $_SESSION['user']['username']; ?>'s Profile</h1>
</article>

<!-- <img src="<?= $_SESSION['user']['profile_picture']; ?>" /> -->

<!-- Error messages -->
<?php
$errors = [];

if (isset($_FILES['avatar'])) {
    $file = $_FILES['avatar'];
    $newFile = date('ymd') . '-' . $file['name'];
    $destination = __DIR__ . '/../app/database/database.db' . $newFile;
    // laddas in fel (i usernavigation!)

    if ($file['size'] > 2097152) {
        $errors[] = 'The uploaded file exceeded the file size limit';
    } elseif ($file['type'] === '/gif') {
        $errors[] = 'The image file type is not allowed';
    } else move_uploaded_file($file['tmp_name'], $newFile);
}
?>


<!-- PROFILE PIC -->
<?php foreach ($errors as $error) : ?>
    <p class="error"> <?= $error ?> </p>
<?php endforeach; ?>

<form action="profile.php" method="post" enctype=multipart/form-data> <div>
    <label for="avatar">Choose a profile picture</label>
    <input type="file" accepts="jpeg, png" name="avatar" id="avatar" required>
    </div>

    <button type="submit">Upload</button>
</form>

<?php
$query = 'INSERT INTO users (profile_picture) VALUES (:profile_picture)';
$statement = $pdo->prepare($query);
//Error info
if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}

// Prepare, bind email parameter and execute the database query.
$statement->bindParam(':profile_picture', $profile_picture, PDO::PARAM_LOB);
$statement->execute();
?>

<?php require __DIR__ . '/../views/footer.php'; ?>