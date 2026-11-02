<?php
// contact.php - EcoMart Customer Contact Page
require_once __DIR__ . '/includes/functions.php';

$errors = [];
$name = '';
$email = '';
$subject = '';
$message = '';
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validations
    if (empty($name)) $errors['name'] = 'Your name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid email is required.';
    if (empty($subject)) $errors['subject'] = 'Please enter a message subject.';
    if (empty($message) || strlen($message) < 10) $errors['message'] = 'Please write a message of at least 10 characters.';

    if (empty($errors)) {
        $submitted = true;
        setFlashMessage('success', "Thank you, {$name}! Your message has been received. Our green support team will review your inquiry shortly.");
        // Reset fields
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}

$pageTitle = 'Contact EcoMart Support';
$metaDescription = 'Have inquiries or need help with your sustainable orders? Reach out to the EcoMart customer care team.';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Contact Header -->
<section class="page-header" style="padding: 60px 0;">
    <div class="container">
        <h1 class="page-title">We Would Love To Hear From You</h1>
        <p class="section-subtitle" style="color: #d1dfcf; max-width: 600px; margin: 10px auto 0;">
            Questions about our zero-waste materials, bulk artisan orders, or shipping? Send us a message below.
        </p>
    </div>
</section>

<section style="padding: 70px 0 90px; background: var(--cream);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 48px; align-items: start;">
            <!-- Left Column: Contact Details -->
            <div>
                <div class="form-card" style="margin-bottom: 24px;">
                    <h3 style="font-size: 1.35rem; color: var(--forest-green); font-weight: 700; margin-bottom: 20px;">
                        Customer Care
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 20px; font-size: 0.95rem;">
                        <div style="display: flex; gap: 16px;">
                            <span style="font-size: 1.4rem;">📍</span>
                            <div>
                                <strong style="color: var(--forest-green); display: block;">EcoMart Headquarters</strong>
                                <span style="color: var(--text-muted);">42 Green Canopy Road, Indiranagar, Bengaluru, Karnataka 560038</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px;">
                            <span style="font-size: 1.4rem;">✉️</span>
                            <div>
                                <strong style="color: var(--forest-green); display: block;">Direct Inquiries</strong>
                                <span style="color: var(--text-muted);">hello@ecomart-example.com</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px;">
                            <span style="font-size: 1.4rem;">📞</span>
                            <div>
                                <strong style="color: var(--forest-green); display: block;">Helpline (Mon - Sat)</strong>
                                <span style="color: var(--text-muted);">+91 (080) 2468-9100 (9:00 AM – 6:00 PM IST)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="demo-credentials-box">
                    <strong style="color: var(--forest-green); display: block; margin-bottom: 4px;">Demonstration System Notice:</strong>
                    <span>Submissions on this form are demonstration validated inside the application without sending real emails to an external SMTP server.</span>
                </div>
            </div>

            <!-- Right Column: Contact Form -->
            <div class="form-card">
                <h3 style="font-size: 1.35rem; color: var(--forest-green); font-weight: 700; margin-bottom: 20px;">
                    Send Us a Message
                </h3>

                <form action="contact.php" method="POST" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contactName" class="form-label">Your Name *</label>
                            <input type="text" id="contactName" name="name" class="form-control" 
                                   value="<?= e($name) ?>" placeholder="e.g. Maya Krishnan" required>
                            <?php if (!empty($errors['name'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['name']) ?></div><?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="contactEmail" class="form-label">Email Address *</label>
                            <input type="email" id="contactEmail" name="email" class="form-control" 
                                   value="<?= e($email) ?>" placeholder="maya@example.com" required>
                            <?php if (!empty($errors['email'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['email']) ?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contactSubject" class="form-label">Subject *</label>
                        <input type="text" id="contactSubject" name="subject" class="form-control" 
                               value="<?= e($subject) ?>" placeholder="e.g. Question about bulk organic tote orders" required>
                        <?php if (!empty($errors['subject'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['subject']) ?></div><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="contactMessage" class="form-label">Message *</label>
                        <textarea id="contactMessage" name="message" class="form-control" rows="5" 
                                  placeholder="Write your message or inquiry here..." required><?= e($message) ?></textarea>
                        <?php if (!empty($errors['message'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['message']) ?></div><?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" id="submitContactBtn">
                        Send Message ➔
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
