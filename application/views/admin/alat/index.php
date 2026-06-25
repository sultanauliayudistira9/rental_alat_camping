<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Alat - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #ecf0f1; }
        .topbar { background: #2c3e50; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .topbar a { color: #fff; text-decoration: none; }
        .content { padding: 40px; }
        .head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        h1 { color: #2c3e50; }
        .btn { background: #27ae60; color: #fff; padding: 10px 18px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn-edit { background: #2980b9; padding: 6px 12px; }
        .btn-hapus { background: #c0392b; padding: 6px 12px; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #34495e; color: #fff; }
        tr:hover { background: #f9f9f9; }
        a { color: #fff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="topbar">
        <span>Admin Panel - Rental Alat Camping</span>
        <a href="<?= base_url('index.php/admin/dashboard') ?>">← Dashboard</a>
    </div>
    <div class="content">
        <div class="head">
            <h1>Kelola Alat</h1>
            <a href="<?= base_url('index.php/admin/alat/tambah') ?>" class="btn">+ Tambah Alat</a>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Harga Sewa/Hari</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; foreach ($alat as $a): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $a->nama_alat ?></td>
                <td><?= $a->nama_kategori ?></td>
                <td>Rp <?= number_format($a->harga_sewa, 0, ',', '.') ?></td>
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
</body>
</html>