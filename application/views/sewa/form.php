<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Alat - Rental Camping</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f4f6f7; }
        .navbar { background: #27ae60; color: #fff; padding: 18px 40px; }
        .navbar a { color: #fff; text-decoration: none; }
        .content { padding: 40px; max-width: 550px; margin: 0 auto; }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        .card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .info { background: #eafaf1; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .info h3 { color: #27ae60; }
        .info p { color: #555; font-size: 14px; margin-top: 4px; }
        label { display: block; margin-bottom: 6px; color: #555; font-weight: bold; font-size: 14px; }
        input { width: 100%; padding: 10px; margin-bottom: 18px; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #e67e22; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #d35400; }
        .error { background: #ffe0e0; color: #c0392b; padding: 10px; border-radius: 5px; margin-bottom: 18px; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="<?= base_url('index.php/home') ?>">← Kembali ke Katalog</a>
    </div>
    <div class="content">
        <h1>Form Penyewaan</h1>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="error"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="info">
                <h3><?= $alat->nama_alat ?></h3>
                <p>Harga: Rp <?= number_format($alat->harga_sewa, 0, ',', '.') ?>/hari &middot; Stok tersedia: <?= $alat->stok ?> unit</p>
            </div>

            <form action="<?= base_url('index.php/sewa/proses') ?>" method="post">
                <input type="hidden" name="alat_id" value="<?= $alat->id ?>">

                <label>Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" required>

                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required>

                <label>Jumlah Unit</label>
                <input type="number" name="jumlah" min="1" max="<?= $alat->stok ?>" value="1" required>

                <button type="submit">Konfirmasi Sewa</button>
            </form>
        </div>
    </div>
</body>
</html>