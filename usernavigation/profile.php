<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>


<section class="user-profile">

</section>

<article>
    <h2><?= $_SESSION['user']['username'];  ?>'s Profile</h2>
</article>
<!-- PROFILE PIC -->

<?php require __DIR__ . '/../views/footer.php'; ?>