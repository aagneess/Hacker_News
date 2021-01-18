<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$userId = $_GET['userId'];
$usersProfile = getUserById($pdo, $userId);
//die(var_dump($usersProfile));

foreach ($usersProfile as $user) : ?>

    <section class="user-profile">
        <h2 class="col-sm"><?= $user['username']  ?></h2>

        <p class="col-sm">Bio: <?= $user['bio'];  ?></p>
    </section>

<?php endforeach; ?>

<?php require __DIR__ . '/views/footer.php'; ?>