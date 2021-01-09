<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<article>
    <h2>Account Settings</h2>
</article>

<?php
$user = getUserId($_SESSION['user']['id'], $pdo);
$id = (int) $_SESSION['user']['id'];
?>

<!-- AVATAR -->
<form action="/../app/users/updatebio.php" method="post" enctype="multipart/form-data">
    <div class="avatar">
        <label class="avatar" for="avatar">Choose an image to upload:</label>
        <input type="file" accept=".png, .jpg, .jpeg" name="avatar" id="avatar" required>
    </div>
    <button class="btn btn-primary" type="submit" name="sumbit" value="submit">Update Profile Picture</button>
</form>

<!-- BIO -->
<form action="/../app/users/updatebio.php" method="post">
    <div class="update-bio">
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"><?= $_SESSION['user']['bio'] ?></textarea>
    </div>
    <button class="btn btn-primary" type="submit" name="sumbit" value="submit">Update Bio</button>
</form>

<!-- EMAIL -->
<form action="/../app/users/updateemail.php" method="post">
    <div class="update-email">
        <label for="email"> Email:</label>
        <input type="email" name="email" id="email" placeholder="<?php echo $_SESSION['user']['email']; ?>">
    </div>
    <button class="btn btn-primary" type="submit" name="sumbit" value="submit">Update Email Address</button>
</form>

<!-- PASSWORD -->
<form action="/../app/users/updatepassword.php" method="post">
    <div class="update-password">
        <label for="password"> Current password </label>
        <input type="password" name="current-password" id="current-passord" required>

        <label for="password"> New password </label>
        <input type="password" name="new-password" id="new-password">

        <label for="password"> Repeat new password </label>
        <input type="password" name="repeat-password" id="repeat-password">

        <button class="btn btn-primary" type="submit" name="sumbit" value="submit">Update Password</button>
    </div>
</form>


<?php require __DIR__ . '/../views/footer.php'; ?>