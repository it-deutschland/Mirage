<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';

$user = requireUser();
$title = 'Dashboard';
require __DIR__ . '/../includes/header.php';
?>
<div class="row g-4">
    <div class="col-lg-5">
        <div class="card app-card p-4 fade-in h-100">
            <h2 class="h5">Willkommen</h2>
            <p class="mb-1"><strong>Name:</strong> <?= e($user['name']) ?></p>
            <p class="mb-1"><strong>Username:</strong> @<?= e($user['telegram_username'] ?? '-') ?></p>
            <p class="mb-0"><strong>Telegram ID:</strong> <?= e((string) $user['telegram_id']) ?></p>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card app-card p-4 fade-in h-100">
            <h2 class="h5 mb-3">Cryptovoucher einlösen</h2>
            <form method="post" action="<?= e(appUrl('/payment/voucher')) ?>">
                <?= csrfField('voucher_submit') ?>
                <div class="mb-3">
                    <label class="form-label">Betrag</label>
                    <div class="amount-grid">
                        <?php foreach (ALLOWED_AMOUNTS as $amount): ?>
                            <label class="amount-card">
                                <input type="radio" name="amount" value="<?= e((string)$amount) ?>" required>
                                <span><?= e((string)$amount) ?> €</span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="voucher_code">Cryptovoucher Code</label>
                    <input class="form-control" id="voucher_code" name="voucher_code" maxlength="255" minlength="6" required>
                </div>
                <button class="btn btn-primary" type="submit">Voucher einreichen</button>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
