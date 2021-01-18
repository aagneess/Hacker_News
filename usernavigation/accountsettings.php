<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<article>
    <h2>Account Settings</h2>
</article>

<?php
$id = $_SESSION['user']['id'];
$user = getUserId($pdo, $id);
?>

<!-- AVATAR -->
<form class="form-control-file" action="/app/users/updateavatar.php" method="post" enctype="multipart/form-data">
    <label class="avatar" for="avatar">Choose an image to upload:</label>
    <input type="file" accept="/png, /jpg, /jpeg" name="avatar" id="avatar" required>
    <button class="btn btn-info" type="submit" name="sumbit" value="submit">Update Profile Picture</button>
</form><br>

<!-- BIO -->
<form class="update-bio" action="/app/users/updatebio.php" method="post">
    <div class="form-group">
        <label for="bio">Here you can write a new bio:</label><br>
        <textarea id="bio" name="bio"><?= $_SESSION['user']['bio'] ?></textarea><br>
        <button class="btn btn-info" type="submit" name="sumbit" value="submit">Update Bio</button>
    </div>
</form><br>

<!-- EMAIL -->
<form class="update-email" action="/app/users/updateemail.php" method="post">
    <div class="form-group">
        <label for="email"> Here you can change your email address:</label><br>
        <input type="email" name="email" id="email" placeholder="<?php echo $_SESSION['user']['email']; ?>">
        <button class="btn btn-info" type="submit" name="sumbit" value="submit">Update Email Address</button>
    </div>
</form><br>

<!-- PASSWORD -->
<form class="update-password" action="/app/users/updatepassword.php" method="post">
    <div class="form-group">
        <label for="password"> Current password: </label>
        <input type="password" name="current-password" id="current-passord" required><br>

        <label for="password"> New password: </label>
        <input type="password" name="new-password" id="new-password"><br>

        <label for="password"> Repeat new password: </label>
        <input type="password" name="repeat-password" id="repeat-password"><br>

        <button class="btn btn-info" type="submit" name="sumbit" value="submit">Update Password</button>
    </div>
</form>


<?php require __DIR__ . '/../views/footer.php'; ?>