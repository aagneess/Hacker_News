<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$userId = $_GET['userId'];
$usersProfile = getUserById($pdo, $userId);
//die(var_dump($usersProfile));

foreach ($usersProfile as $user) : ?>

    <section class="user-profile">
        <h2><?= $user['username']  ?>'s Profile</h2>

        <p>Bio: <?= $user['bio'];  ?></p>
    </section>
    <!-- PROFILE PIC <img src="/app/users/uploads/default.php" /> -->


<?php endforeach; ?>

<?php require __DIR__ . '/views/footer.php'; ?>