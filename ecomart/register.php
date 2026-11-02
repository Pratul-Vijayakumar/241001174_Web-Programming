<?php
// register.php - EcoMart User Registration Page (Session-based Demo Registration)
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$name = '';
$email = '';
$success = false;

// If already logged in, redirect
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validations
    if (empty($name)) {
        $errors['name'] = 'Full name is required.';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Name must be at least 2 characters.';
    }

    if (empty($email)) {
        $errors['email'] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password should be at least 6 characters.';
    }

    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        // Store in session temporary registered users array
        if (!isset($_SESSION['registered_users'])) {
            $_SESSION['registered_users'] = [];
        }

        $_SESSION['registered_users'][$email] = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'registered_at' => date('Y-m-d H:i:s')
        ];

        // Also automatically log in the registered user
        $_SESSION['ecomart_user'] = [
            'name' => $name,
            'email' => $email,
            'logged_in_at' => date('Y-m-d H:i:s')
        ];

        setFlashMessage('success', "Account successfully created! Welcome to EcoMart, {$name}.");
        header('Location: index.php');
        exit;
    }
}

$pageTitle = 'Join EcoMart';
require_once __DIR__ . '/includes/header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-box" style="margin: 0 auto;">
            <div class="auth-header">
                <span style="font-size: 2.2rem;">🌿</span>
                <h1 class="auth-title">Create EcoMart Account</h1>
                <p class="auth-subtitle">Join thousands taking small steps toward a zero-waste planet.</p>
            </div>

            <div class="demo-credentials-box">
                <strong style="color: var(--forest-green);">Note:</strong> This registration stores user credentials securely in your current <strong>PHP Session</strong> for demo purposes without requiring a database.
            </div>

            <form action="register.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="regName" class="form-label">Full Name</label>
                    <input type="text" id="regName" name="name" class="form-control" 
                           value="<?= e($name) ?>" placeholder="e.g. Rahul Sharma" required>
                    <?php if (!empty($errors['name'])): ?>
                        <div class="form-help" style="color: #dc3545;"><?= e($errors['name']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="regEmail" class="form-label">Email Address</label>
                    <input type="email" id="regEmail" name="email" class="form-control" 
                           value="<?= e($email) ?>" placeholder="e.g. rahul@example.com" required>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="form-help" style="color: #dc3545;"><?= e($errors['email']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="regPassword" class="form-label">Password</label>
                    <input type="password" id="regPassword" name="password" class="form-control" 
                           placeholder="At least 6 characters" required>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="form-help" style="color: #dc3545;"><?= e($errors['password']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="regConfirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" id="regConfirmPassword" name="confirm_password" class="form-control" 
                           placeholder="Repeat your password" required>
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <div class="form-help" style="color: #dc3545;"><?= e($errors['confirm_password']) ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg" id="submitRegisterBtn" style="margin-top: 10px;">
                    Complete Registration
                </button>
            </form>

            <div class="auth-footer">
                Already registered? <a href="login.php">Log In instead</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
