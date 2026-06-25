<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alat - Admin</title>
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
        h1 { color: #fff; margin-bottom: 24px; }
        .card { background: #1a2942; padding: 30px; border-radius: 14px; box-shadow: 0 8px 24px rgba(0,0,0,0.25); max-width: 600px; border: 1px solid rgba(255,255,255,0.05); }
        label { display: block; margin-bottom: 6px; color: #9fb3c8; font-weight: 600; font-size: 14px; }
        input, select, textarea { width: 100%; padding: 11px; margin-bottom: 18px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; font-family: 'Segoe UI', Arial; background: #0f1c2e; color: #e8edf2; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #2ecc71; }
        button { background: #2980b9; color: #fff; padding: 12px 26px; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; }
        button:hover { background: #2471a3; }
        .batal { background: #34495e; color: #fff; padding: 12px 26px; text-decoration: none; border-radius: 8px; font-size: 15px; }
        .error { background: rgba(231,76,60,0.15); color: #e74c3c; padding: 12px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; }
        .foto-now { margin-bottom: 18px; }
        .foto-now img { width: 120px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); }
        .foto-now .none { color: #5a7290; font-size: 13px; }
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
            <h1>Edit Alat</h1>
            <div class="card">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="error"><?= $this->session->flashdata('error') ?></div>
                <?php endif; ?>
                <form action="<?= base_url('index.php/admin/alat/update/'.$alat->id) ?>" method="post" enctype="multipart/form-data">
                    <label>Nama Alat</label>
                    <input type="text" name="nama_alat" value="<?= $alat->nama_alat ?>" required>

                    <label>Kategori</label>
                    <select name="kategori_id" required>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k->id ?>" <?= $k->id == $alat->kategori_id ? 'selected' : '' ?>>
                                <?= $k->nama_kategori ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="3"><?= $alat->deskripsi ?></textarea>

                    <label>Harga Sewa per Hari (Rp)</label>
                    <input type="number" name="harga_sewa" value="<?= $alat->harga_sewa ?>" required>

                    <label>Stok</label>
                    <input type="number" name="stok" value="<?= $alat->stok ?>" required>

                    <label>Kondisi</label>
                    <select name="kondisi">
                        <option value="baik" <?= $alat->kondisi == 'baik' ? 'selected' : '' ?>>Baik</option>
                        <option value="rusak ringan" <?= $alat->kondisi == 'rusak ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                        <option value="perbaikan" <?= $alat->kondisi == 'perbaikan' ? 'selected' : '' ?>>Perbaikan</option>
                    </select>

                    <label>Foto Saat Ini</label>
                    <div class="foto-now">
                        <?php if ($alat->gambar): ?>
                            <img src="<?= base_url('uploads/'.$alat->gambar) ?>" alt="foto">
                        <?php else: ?>
                            <span class="none">Belum ada foto</span>
                        <?php endif; ?>
                    </div>

                    <label>Ganti Foto (kosongkan jika tidak diganti)</label>
                    <input type="file" name="gambar" accept="image/*">

                    <button type="submit">Update</button>
                    <a href="<?= base_url('index.php/admin/alat') ?>" class="batal">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>