<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
$title = 'Mirage Projekt';
require __DIR__ . '/includes/header.php';
?>
<div class="card app-card p-4 fade-in">
    <h1 class="h3 mb-3">Mirage Projekt CMS</h1>
    <p class="text-secondary">Sicheres Voucher- und Admin-CMS mit Telegram-Login.</p>
    <div class="d-flex flex-wrap gap-2 mt-3">
        <a class="btn btn-primary" href="<?= e(appUrl('/login/telegram')) ?>">Telegram Login</a>
        <a class="btn btn-outline-light" href="<?= e(appUrl('/admin/login')) ?>">Admin Login</a>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
