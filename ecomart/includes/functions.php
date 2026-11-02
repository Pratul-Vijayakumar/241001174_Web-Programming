<?php
// EcoMart Core Helper Functions

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Sanitize and escape string for safe HTML output
 */
function e($string) {
    return htmlspecialchars((string)$string, ENT_QUOTES, 'UTF-8');
}

/**
 * Format currency to Indian Rupees
 */
function formatRupees($amount) {
    return '₹' . number_format((float)$amount, 2);
}

/**
 * Check if demo user is logged in via session
 */
function isLoggedIn() {
    return !empty($_SESSION['ecomart_user']);
}

/**
 * Get currently logged-in user data
 */
function getCurrentUser() {
    return isLoggedIn() ? $_SESSION['ecomart_user'] : null;
}

/**
 * Set flash alert message
 */
function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type, // 'success', 'error', 'info', 'warning'
        'message' => $message
    ];
}

/**
 * Get and clear flash alert message
 */
function getFlashMessage() {
    if (!empty($_SESSION['flash_message'])) {
        $msg = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $msg;
    }
    return null;
}

/**
 * Display flash message HTML if set
 */
function renderFlashMessage() {
    $msg = getFlashMessage();
    if ($msg) {
        $type = e($msg['type']);
        $text = e($msg['message']);
        $icon = ($type === 'success') ? '✓' : (($type === 'error') ? '⚠' : 'ℹ');
        echo "
        <div class='flash-alert alert-{$type}'>
            <span class='alert-icon'>{$icon}</span>
            <span class='alert-text'>{$text}</span>
            <button type='button' class='alert-close' onclick='this.parentElement.remove()'>&times;</button>
        </div>";
    }
}
