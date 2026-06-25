<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Alat - Admin</title>
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
        .head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        h1 { color: #fff; }
        .btn-add { background: #2ecc71; color: #0f1c2e; padding: 11px 20px; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; }
        .btn-add:hover { background: #27ae60; color: #fff; }
        table { width: 100%; border-collapse: collapse; background: #1a2942; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.25); }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); vertical-align: middle; }
        th { background: #0a1422; color: #9fb3c8; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        td { color: #e8edf2; font-size: 14px; }
        tr:hover td { background: rgba(255,255,255,0.02); }
        .foto { width: 60px; height: 45px; object-fit: cover; border-radius: 6px; }
        .no-foto { color: #5a7290; font-size: 12px; }
        .harga { color: #2ecc71; font-weight: 600; }
        .btn { text-decoration: none; padding: 6px 14px; border-radius: 6px; font-size: 13px; color: #fff; }
        .btn-edit { background: #2980b9; }
        .btn-hapus { background: #c0392b; }
    </style>
</head>
<body>
    <div class="layout">
        <div class="sidebar">
            <div class="brand">🏕️ Admin Panel</div>
            <div class="menu">
                <a href="<?= base_url('index.php/admin/dashboard') ?>">📊 Dashboard</a>
                <a href="<?= base_url('index.php/admin/alat') ?>" class="active">📦 Kelola Alat</a>
                <a href="<?= base_url('index.php/admin/transaksi') ?>">🧾 Kelola Transaksi</a>
            </div>
            <div class="logout">
                <a href="<?= base_url('index.php/admin/auth/logout') ?>">Logout</a>
            </div>
        </div>
        <div class="main">
            <div class="head">
                <h1>Kelola Alat</h1>
                <a href="<?= base_url('index.php/admin/alat/tambah') ?>" class="btn-add">+ Tambah Alat</a>
            </div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Harga/Hari</th>
                    <th>Stok</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
                <?php $no = 1; foreach ($alat as $a): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if ($a->gambar): ?>
                            <img class="foto" src="<?= base_url('uploads/'.$a->gambar) ?>" alt="<?= $a->nama_alat ?>">
                        <?php else: ?>
                            <span class="no-foto">-</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $a->nama_alat ?></td>
                    <td><?= $a->nama_kategori ?></td>
                    <td class="harga">Rp <?= number_format($a->harga_sewa, 0, ',', '.') ?></td>
                    <td><?= $a->stok ?></td>
                    <td><?= $a->kondisi ?></td>
                    <td>
                        <a href="<?= base_url('index.php/admin/alat/edit/'.$a->id) ?>" class="btn btn-edit">Edit</a>
                        <a href="<?= base_url('index.php/admin/alat/hapus/'.$a->id) ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus alat ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>