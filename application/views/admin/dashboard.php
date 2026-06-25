<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #ecf0f1; }
        .topbar { background: #2c3e50; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .topbar a { color: #fff; text-decoration: none; background: #c0392b; padding: 8px 16px; border-radius: 5px; font-size: 14px; }
        .content { padding: 40px; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="topbar">
        <span>Admin Panel - Rental Alat Camping</span>
        <a href="<?= base_url('index.php/admin/auth/logout') ?>">Logout</a>
    </div>
    <div class="content">
        <div class="card">
            <h1>Selamat datang, <?= $nama ?>!</h1>
            <p>Ini dashboard admin. Nanti di sini ada menu kelola alat, kategori, dan transaksi.</p>
        </div>
    </div>
</body>
</html>