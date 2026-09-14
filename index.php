<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
$title = 'Mirage Projekt';
require __DIR__ . '/includes/header.php';
?>
<section class="app-card hero-banner reveal-up">
    <div class="hero-media">
        <img src="<?= e($mirageHeaderImage) ?>" alt="Mirage VIP Header">
    </div>
    <div class="hero-overlay p-4 p-lg-5">
        <div class="hero-copy">
            <span class="cyber-chip">Mirage VIP Lounge</span>
            <h1 class="hero-title mt-3 mb-3">Telegram-first access in einem futuristischen VIP Kosmos</h1>
            <p class="mb-0">Das bestehende Mirage Panel bleibt funktional identisch und führt Nutzer weiter sicher durch Login, Freischaltung und Voucher-Flow – jetzt jedoch in einer deutlich stärkeren Premium-Cyberpunk-Inszenierung.</p>
            <div class="hero-meta">
                <span class="cyber-chip">Private Access</span>
                <span class="cyber-chip">Cyber Luxury</span>
                <span class="cyber-chip">Instant Telegram Flow</span>
            </div>
            <div class="d-flex flex-wrap gap-2 mt-4">
                <a class="btn btn-primary" href="<?= e(appUrl('/login/telegram')) ?>">Telegram Login</a>
                <a class="btn btn-outline-light" href="<?= e(appUrl('/admin/login')) ?>">Admin Login</a>
            </div>
        </div>
    </div>
</section>

<div class="row g-4 mt-1">
    <div class="col-lg-4 reveal-up">
        <div class="app-card surface-panel p-4 h-100">
            <span class="cyber-chip">Private Entrance</span>
            <h2 class="h4 mt-3">Login ohne Umwege</h2>
            <p class="mb-0">Kunden gelangen direkt über Telegram in den privaten Bereich und bleiben im bestehenden Ablauf, nur mit deutlich edlerem Look & Feel.</p>
        </div>
    </div>
    <div class="col-lg-4 reveal-up">
        <div class="app-card surface-panel p-4 h-100">
            <span class="cyber-chip">VIP Delivery</span>
            <h2 class="h4 mt-3">Voucher & Zugriff</h2>
            <p class="mb-0">Das User-Dashboard fokussiert weiter auf den Voucher-Prozess, aber jetzt mit mehr Glanz, Tiefe, Neonflächen und futuristischen Bewegungen.</p>
        </div>
    </div>
    <div class="col-lg-4 reveal-up">
        <div class="app-card surface-panel p-4 h-100">
            <span class="cyber-chip">Admin Control</span>
            <h2 class="h4 mt-3">Klare Kontrolle</h2>
            <p class="mb-0">Auch das Admin-Panel wirkt nun wie ein hochwertiges Backoffice für eine exklusive Telegram-basierte Premium-Plattform.</p>
        </div>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
