<?php
// login.php - EcoMart User Login Page (Session-based Demo Authentication)
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$email = '';

// If already logged in, redirect to home or checkout
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Process login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Form Validation
    if (empty($email)) {
        $errors['email'] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    // Demo Authentication Logic
    // Matches the documented demo credentials or any demo registration in session
    if (empty($errors)) {
        $isValid = false;
        $userName = 'Eco Member';

        // Check against demo master account
        if ($email === 'demo@ecomart.com' && $password === 'green123') {
            $isValid = true;
            $userName = 'Priya Sharma';
        }
        // Check against any account registered during this demo session
        elseif (!empty($_SESSION['registered_users'][$email]) && $_SESSION['registered_users'][$email]['password'] === $password) {
            $isValid = true;
            $userName = $_SESSION['registered_users'][$email]['name'];
        }

        if ($isValid) {
            $_SESSION['ecomart_user'] = [
                'name' => $userName,
                'email' => $email,
                'logged_in_at' => date('Y-m-d H:i:s')
            ];
            setFlashMessage('success', "Welcome back, {$userName}! You have successfully logged in.");
            
            // Redirect to redirect parameter or home
            $redirect = !empty($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
            header("Location: {$redirect}");
            exit;
        } else {
            $errors['general'] = 'Invalid email or password. Please use the demo credentials provided below.';
        }
    }
}

$pageTitle = 'Member Login';
require_once __DIR__ . '/includes/header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-box" style="margin: 0 auto;">
            <div class="auth-header">
                <span style="font-size: 2.2rem;">🌱</span>
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Log in to track orders, manage your wishlist, and save the planet.</p>
            </div>

            <!-- Demo Credentials Helper Box -->
            <div class="demo-credentials-box">
                <strong style="color: var(--forest-green); display: block; margin-bottom: 4px;">Demo Authentication Credentials:</strong>
                <div>Email: <code>demo@ecomart.com</code></div>
                <div>Password: <code>green123</code></div>
                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 4px;">(Temporary demonstration session authentication. No database is used.)</div>
            </div>

            <?php if (!empty($errors['general'])): ?>
                <div class="flash-alert alert-error" style="margin-bottom: 20px;">
                    <span class="alert-icon">⚠</span>
                    <span class="alert-text"><?= e($errors['general']) ?></span>
                </div>
            <?php endif; ?>

            <form action="login.php<?= !empty($_GET['redirect']) ? '?redirect=' . urlencode($_GET['redirect']) : '' ?>" method="POST" novalidate>
                <div class="form-group">
                    <label for="loginEmail" class="form-label">Email Address</label>
                    <input type="email" id="loginEmail" name="email" class="form-control" 
                           value="<?= e($email) ?>" placeholder="e.g. demo@ecomart.com" required>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="form-help" style="color: #dc3545;"><?= e($errors['email']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" id="loginPassword" name="password" class="form-control" 
                           placeholder="Enter your password" required>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="form-help" style="color: #dc3545;"><?= e($errors['password']) ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg" id="submitLoginBtn" style="margin-top: 10px;">
                    Log In to EcoMart
                </button>
            </form>

            <div class="auth-footer">
                Don't have an account yet? <a href="register.php">Create Account</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
