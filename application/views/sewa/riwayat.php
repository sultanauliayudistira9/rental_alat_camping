<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Saya - Rental Camping</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f4f6f7; }
        .navbar { background: #27ae60; color: #fff; padding: 18px 40px; }
        .navbar a { color: #fff; text-decoration: none; }
        .content { padding: 40px; max-width: 900px; margin: 0 auto; }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        .sukses { background: #d4f5dd; color: #1e7e34; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .trx { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 18px; }
        .trx-head { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px; }
        .tanggal { color: #555; font-size: 14px; }
        .status { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .status.pending { background: #fef3cd; color: #856404; }
        .status.disewa { background: #cce5ff; color: #004085; }
        .status.selesai { background: #d4edda; color: #155724; }
        .status.dibatalkan { background: #f8d7da; color: #721c24; }
        .item { font-size: 14px; color: #444; padding: 3px 0; }
        .total { text-align: right; font-weight: bold; color: #27ae60; font-size: 18px; margin-top: 10px; }
        .kosong { background: #fff; padding: 40px; text-align: center; border-radius: 10px; color: #888; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="<?= base_url('index.php/home') ?>">← Kembali ke Katalog</a>
    </div>
    <div class="content">
        <h1>Riwayat Sewa Saya</h1>

        <?php if ($this->session->flashdata('sukses')): ?>
            <div class="sukses"><?= $this->session->flashdata('sukses') ?></div>
        <?php endif; ?>

        <?php if (empty($transaksi)): ?>
            <div class="kosong">Belum ada transaksi. Yuk sewa alat di katalog!</div>
        <?php else: ?>
            <?php foreach ($transaksi as $t): ?>
            <div class="trx">
                <div class="trx-head">
                    <span class="tanggal"><?= date('d M Y', strtotime($t->tanggal_sewa)) ?> &rarr; <?= date('d M Y', strtotime($t->tanggal_kembali)) ?></span>
                    <span class="status <?= $t->status ?>"><?= ucfirst($t->status) ?></span>
                </div>
                <?php foreach ($t->detail as $d): ?>
                    <div class="item"><?= $d->nama_alat ?> &times; <?= $d->jumlah ?> unit (<?= $d->durasi ?> hari)</div>
                <?php endforeach; ?>
                <div class="total">Total: Rp <?= number_format($t->total_harga, 0, ',', '.') ?></div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>