<?php

declare(strict_types=1);

// In this file we send messages to the user
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo $message;
    unset($_SESSION['message']);
}
