<?php
// logout.php - EcoMart User Logout
require_once __DIR__ . '/includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

unset($_SESSION['ecomart_user']);
setFlashMessage('info', 'You have been logged out safely. Visit again soon! 🌿');

header('Location: index.php');
exit;
