<?php

declare(strict_types=1);

// Messages to the user
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo $message;
    unset($_SESSION['message']);
}
