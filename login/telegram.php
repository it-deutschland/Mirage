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
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card app-card p-4 fade-in">
            <h1 class="h4 mb-3">Login mit Telegram</h1>
            <p class="text-secondary">Melden Sie sich sicher über das Telegram Login Widget an.</p>
            <script async src="https://telegram.org/js/telegram-widget.js?22"
                    data-telegram-login="<?= e((string) cfg('TELEGRAM_BOT_USERNAME', '')) ?>"
                    data-size="large"
                    data-auth-url="<?= e(appUrl('/login/telegram')) ?>"
                    data-request-access="write"></script>
            <?php if (!cfg('TELEGRAM_BOT_USERNAME')): ?>
                <div class="alert alert-warning mt-3">TELEGRAM_BOT_USERNAME ist nicht konfiguriert.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
