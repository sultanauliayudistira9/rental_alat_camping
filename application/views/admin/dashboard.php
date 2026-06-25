<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { background: #0f1c2e; color: #e8edf2; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 240px; background: #0a1422; display: flex; flex-direction: column; border-right: 1px solid rgba(255,255,255,0.06); }
        .sidebar .brand { padding: 24px 22px; font-size: 17px; font-weight: bold; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .sidebar .menu { flex: 1; padding: 16px 0; }
        .sidebar .menu a { display: block; color: #9fb3c8; text-decoration: none; padding: 14px 22px; font-size: 14px; border-left: 3px solid transparent; transition: all 0.2s; }
        .sidebar .menu a:hover, .sidebar .menu a.active { background: rgba(46,204,113,0.1); color: #2ecc71; border-left: 3px solid #2ecc71; }
        .sidebar .logout { padding: 18px 22px; border-top: 1px solid rgba(255,255,255,0.06); }
        .sidebar .logout a { color: #fff; text-decoration: none; background: #c0392b; display: block; text-align: center; padding: 10px; border-radius: 6px; font-size: 14px; }
        .main { flex: 1; padding: 40px; }
        h1 { color: #fff; margin-bottom: 6px; }
        .subtitle { color: #9fb3c8; margin-bottom: 30px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 22px; }
        .card { background: #1a2942; padding: 28px; border-radius: 14px; box-shadow: 0 8px 24px rgba(0,0,0,0.25); text-decoration: none; color: inherit; transition: transform 0.2s; border: 1px solid rgba(255,255,255,0.05); }
        .card:hover { transform: translateY(-5px); box-shadow: 0 14px 32px rgba(46,204,113,0.12); }
        .card .icon { font-size: 34px; margin-bottom: 14px; }
        .card h3 { color: #fff; margin-bottom: 6px; }
        .card p { color: #9fb3c8; font-size: 13px; }
    </style>
</head>
<body>
    <div class="layout">
        <div class="sidebar">
            <div class="brand">🏕️ Admin Panel</div>
            <div class="menu">
                <a href="<?= base_url('index.php/admin/dashboard') ?>" class="active">📊 Dashboard</a>
                <a href="<?= base_url('index.php/admin/alat') ?>">📦 Kelola Alat</a>
                <a href="<?= base_url('index.php/admin/transaksi') ?>">🧾 Kelola Transaksi</a>
            </div>
            <div class="logout">
                <a href="<?= base_url('index.php/admin/auth/logout') ?>">Logout</a>
            </div>
        </div>
        <div class="main">
            <h1>Selamat datang, <?= $nama ?>!</h1>
            <p class="subtitle">Kelola rental alat camping dari panel ini.</p>
            <div class="cards">
                <a href="<?= base_url('index.php/admin/alat') ?>" class="card">
                    <div class="icon">📦</div>
                    <h3>Kelola Alat</h3>
                    <p>Tambah, edit, dan hapus alat camping</p>
                </a>
                <a href="<?= base_url('index.php/admin/transaksi') ?>" class="card">
                    <div class="icon">🧾</div>
                    <h3>Kelola Transaksi</h3>
                    <p>Lihat dan ubah status penyewaan</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>