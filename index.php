<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
$title = 'Mirage Projekt';
require __DIR__ . '/includes/header.php';
?>
<section class="app-card hero-stage hero-stage--centered reveal-up fx-tilt" data-tilt-card>
    <div class="hero-stage__glow"></div>
    <div class="hero-stage__media">
        <img src="<?= e($mirageHeaderImage) ?>" alt="Mirage VIP Header">
    </div>
    <div class="hero-stage__content p-4 p-lg-5">
        <div class="hero-copy hero-copy--centered mx-auto">
            <span class="cyber-chip">Mirage VIP Lounge</span>
            <h1 class="hero-title mt-3 mb-3">Zentraler VIP-Einstieg mit starkem Mirage Fokus</h1>
            <p class="mb-0">Die Header-Grafik steht jetzt zentral im Mittelpunkt und trägt die komplette Startseite mit einem luxuriösen Neon-Look für exklusive Telegram-basierte Premium-Inhalte.</p>
            <div class="hero-meta hero-meta--centered">
                <span class="cyber-chip">Private Access</span>
                <span class="cyber-chip">Nightlife Aura</span>
                <span class="cyber-chip">Telegram Delivery</span>
            </div>
            <div class="d-flex flex-wrap gap-2 mt-4 justify-content-center">
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
            <p class="mb-0">Kunden gelangen direkt über Telegram in den privaten Bereich und erleben einen sinnlich-luxuriösen Einstieg mit stärkerem VIP-Charakter.</p>
        </div>
    </div>
    <div class="col-lg-4 reveal-up">
        <div class="app-card surface-panel p-4 h-100">
            <span class="cyber-chip">VIP Delivery</span>
            <h2 class="h4 mt-3">Voucher & Zugriff</h2>
            <p class="mb-0">Der bestehende Voucher-Prozess bleibt erhalten, wird aber mit mehr Neon, Glanz und einer exklusiven Adult-Premium-Atmosphäre inszeniert.</p>
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
