<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/telegram.php';

if (isset($_GET['id'], $_GET['hash'], $_GET['auth_date'])) {
    if (!verifyTelegramAuth($_GET)) {
        http_response_code(403);
        exit('Telegram authentication failed.');
    }

    $telegramId = (int) $_GET['id'];
    $username = isset($_GET['username']) ? mb_substr((string) $_GET['username'], 0, 255) : null;
    $firstName = mb_substr((string) ($_GET['first_name'] ?? ''), 0, 255);
    $lastName = mb_substr((string) ($_GET['last_name'] ?? ''), 0, 255);
    $name = trim($firstName . ' ' . $lastName);
    if ($name === '') {
        $name = $username ?? ('Telegram-' . $telegramId);
    }
    $photo = isset($_GET['photo_url']) ? mb_substr((string) $_GET['photo_url'], 0, 1024) : null;

    $pdo = db();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE telegram_id = ? LIMIT 1');
    $stmt->execute([$telegramId]);
    $existing = $stmt->fetch();

    if ($existing) {
        $update = $pdo->prepare('UPDATE users SET telegram_username = ?, name = ?, avatar = ?, last_login = NOW(), last_ip = ?, updated_at = NOW() WHERE id = ?');
        $update->execute([$username, $name, $photo, clientIp(), $existing['id']]);
        $userId = (int) $existing['id'];
    } else {
        $insert = $pdo->prepare('INSERT INTO users (telegram_id, telegram_username, name, avatar, last_login, last_ip) VALUES (?, ?, ?, ?, NOW(), ?)');
        $insert->execute([$telegramId, $username, $name, $photo, clientIp()]);
        $userId = (int) $pdo->lastInsertId();
    }

    $fresh = $pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
    $fresh->execute([$userId]);
    $user = $fresh->fetch();
    if (!$user) {
        throw new RuntimeException('User fetch failed.');
    }

    loginUser($user);
    redirect('/dashboard');
}

$title = 'Telegram Login';
require __DIR__ . '/../includes/header.php';
?>
<div class="row g-4 login-grid">
    <div class="col-lg-7">
        <section class="app-card hero-banner reveal-up h-100">
            <div class="hero-media">
                <img src="<?= e($mirageHeaderImage) ?>" alt="Mirage VIP Header">
            </div>
            <div class="hero-overlay p-4 p-lg-5">
                <div class="hero-copy">
                    <span class="cyber-chip">Telegram Gateway</span>
                    <h1 class="hero-title mt-3 mb-3">Direkter Eintritt in den Mirage VIP Bereich</h1>
                    <p class="mb-0">Nutzer melden sich weiterhin sicher per Telegram an und werden danach unverändert in ihr Dashboard weitergeleitet – jetzt in einer deutlich atmosphärischeren Neon-VIP-Umgebung.</p>
                    <div class="feature-stack mt-4">
                        <span class="cyber-chip">Fast Auth</span>
                        <span class="cyber-chip">Private Session</span>
                        <span class="cyber-chip">Premium Staging</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-5">
        <div class="app-card p-4 p-lg-5 fade-in h-100 fx-tilt" data-tilt-card>
            <span class="cyber-chip">Secure Login</span>
            <h2 class="h4 mt-3 mb-3">Login mit Telegram</h2>
            <p class="text-secondary">Melden Sie sich sicher über das Telegram Login Widget an.</p>
            <div class="muted-divider my-4"></div>
            <div class="surface-panel p-4">
                <script async src="https://telegram.org/js/telegram-widget.js?22"
                        data-telegram-login="<?= e((string) cfg('TELEGRAM_BOT_USERNAME', '')) ?>"
                        data-size="large"
                        data-auth-url="<?= e(appUrl('/login/telegram')) ?>"
                        data-request-access="write"></script>
            </div>
            <?php if (!cfg('TELEGRAM_BOT_USERNAME')): ?>
                <div class="alert alert-warning mt-3">TELEGRAM_BOT_USERNAME ist nicht konfiguriert.</div>
            <?php endif; ?>
            <ul class="panel-list mt-4">
                <li><strong>Telegram-only Flow</strong><span class="small-muted">Bestehende Authentifizierung bleibt vollständig erhalten.</span></li>
                <li><strong>VIP Fokus</strong><span class="small-muted">Optik und Oberfläche wirken exklusiver, moderner und hochwertiger.</span></li>
            </ul>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
