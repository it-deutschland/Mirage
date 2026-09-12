<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

$title = $title ?? 'Mirage Projekt';
$admin = $admin ?? null;
$showSidebar = $showSidebar ?? false;
$layoutHasSidebar = $showSidebar && is_array($admin);
?><!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= e(appUrl('/assets/css/style.css')) ?>" rel="stylesheet">
</head>
<body class="app-dark">
<?php if ($layoutHasSidebar): ?>
<div class="d-flex min-vh-100">
    <aside class="sidebar p-3">
        <h4 class="mb-4">Mirage Admin</h4>
        <nav class="nav flex-column gap-2">
            <a class="nav-link" href="<?= e(appUrl('/admin/dashboard')) ?>">Dashboard</a>
            <a class="nav-link" href="<?= e(appUrl('/admin/vouchers')) ?>">Voucher</a>
            <?php if ((int)$admin['rank'] === 3): ?>
                <a class="nav-link" href="<?= e(appUrl('/admin/users')) ?>">Benutzer</a>
                <a class="nav-link" href="<?= e(appUrl('/admin/logs')) ?>">Logs</a>
                <a class="nav-link" href="<?= e(appUrl('/admin/admins')) ?>">Admins</a>
                <a class="nav-link" href="<?= e(appUrl('/admin/edit')) ?>">Audit Edit</a>
            <?php endif; ?>
            <form method="post" action="<?= e(appUrl('/admin/logout')) ?>">
                <?php require_once __DIR__ . '/csrf.php'; ?>
                <?= csrfField('admin_logout') ?>
                <button class="btn btn-outline-danger w-100 mt-3" type="submit">Logout</button>
            </form>
        </nav>
    </aside>
    <main class="flex-grow-1 p-4">
<?php else: ?>
<main class="container py-4">
<?php endif; ?>
