<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php
// In this file we update the users avatar.
$user = getUserId($_SESSION['user']['id'], $pdo);
?>
<section class="user-profile">
    <h2><?= $_SESSION['user']['username'];  ?>'s Profile</h2>

    <p>Bio: <?= $user['bio'];  ?></p>
</section>
<!-- PROFILE PIC -->

<?php require __DIR__ . '/../views/footer.php'; ?>