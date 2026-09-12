<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/permissions.php';

$admin = requireAdmin();
requireActiveAdmin($admin);
$showSidebar = true;
$title = 'Admin Dashboard';

$stats = [
    'pending' => 0,
    'proofed' => 0,
    'invalid' => 0,
    'users' => 0,
];

foreach (['pending', 'proofed', 'invalid'] as $status) {
    $stmt = db()->prepare('SELECT COUNT(*) FROM cryptovouchers WHERE status = ?');
    $stmt->execute([$status]);
    $stats[$status] = (int) $stmt->fetchColumn();
}
$stats['users'] = (int) db()->query('SELECT COUNT(*) FROM users')->fetchColumn();

require __DIR__ . '/../includes/header.php';
?>
<div class="row g-3">
    <div class="col-md-3"><div class="card app-card p-3"><div class="small text-secondary">Pending</div><div class="h3"><?= e((string)$stats['pending']) ?></div></div></div>
    <div class="col-md-3"><div class="card app-card p-3"><div class="small text-secondary">Proofed</div><div class="h3 text-success"><?= e((string)$stats['proofed']) ?></div></div></div>
    <div class="col-md-3"><div class="card app-card p-3"><div class="small text-secondary">Invalid</div><div class="h3 text-danger"><?= e((string)$stats['invalid']) ?></div></div></div>
    <div class="col-md-3"><div class="card app-card p-3"><div class="small text-secondary">Users</div><div class="h3 text-info"><?= e((string)$stats['users']) ?></div></div></div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
