<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
$userId = $_GET['userId'];
$user = getUserById($pdo, $userId);
//die(var_dump($usersProfile));
?>

<section class="col-md-8 offset-md-2">
    <div class="card" style="width: 100%">
        <?php if (!$user['avatar']) : ?>
            <img id="profile-pic" src="/app/users/default.jpg" alt="Profile picture">
        <?php else : ?>
            <img class="card-img-top" src="/app/users/<?= $user['avatar']; ?>" alt="Profile picture">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"><?= $user['username'];  ?></h5>
            <p class="card-text"><?= $user['bio'];  ?></p>
        </div>
    </div>
</section>


<?php require __DIR__ . '/views/footer.php'; ?>