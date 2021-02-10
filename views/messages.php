<?php

declare(strict_types=1);

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
?>

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?= $message; ?>
    </div>

<?php
} ?>