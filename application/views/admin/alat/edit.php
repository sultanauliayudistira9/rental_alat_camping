<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Alat - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #ecf0f1; }
        .topbar { background: #2c3e50; color: #fff; padding: 15px 30px; }
        .topbar a { color: #fff; text-decoration: none; }
        .content { padding: 40px; max-width: 600px; }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        label { display: block; margin-bottom: 6px; color: #555; font-weight: bold; font-size: 14px; }
        input, select, textarea { width: 100%; padding: 10px; margin-bottom: 18px; border: 1px solid #ccc; border-radius: 5px; font-family: Arial; }
        button { background: #2980b9; color: #fff; padding: 12px 24px; border: none; border-radius: 5px; font-size: 15px; cursor: pointer; }
        .batal { background: #95a5a6; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-size: 15px; }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="<?= base_url('index.php/admin/alat') ?>">← Kembali ke Daftar Alat</a>
    </div>
    <div class="content">
        <h1>Edit Alat</h1>
        <div class="card">
            <form action="<?= base_url('index.php/admin/alat/update/'.$alat->id) ?>" method="post">
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

                <button type="submit">Update</button>
                <a href="<?= base_url('index.php/admin/alat') ?>" class="batal">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>