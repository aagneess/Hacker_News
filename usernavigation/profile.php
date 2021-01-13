<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php
// PROFILE
$id = $_SESSION['user']['id'];
$user = getUserById($pdo, $id);

?>
<section class="user-profile">
    <h2><?= $user['username'];  ?>'s Profile</h2>
    <img src="/app/users/uploads/<?= $user['avatar']; ?>" />
    <p>Bio: <?= $user['bio'];  ?></p>
</section>
<!-- PROFILE PIC -->

<?php require __DIR__ . '/../views/footer.php'; ?>