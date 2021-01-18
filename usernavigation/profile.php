<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<?php
// PROFILE
$id = $_SESSION['user']['id'];
$user = getUserById($pdo, $id);
?>
<section class="user-profile">
    <div class="media">
        <img class="mr-3" id="profile-pic" src="/app/users/<?= $user['avatar']; ?>" alt="Profile picture">

        <div class="media-body">
            <h5 class="mt-0"><?= $user['username'];  ?></h5>
            Bio: <?= $user['bio'];  ?>
        </div>
    </div>
</section>
<!-- PROFILE PIC -->

<?php require __DIR__ . '/../views/footer.php'; ?>