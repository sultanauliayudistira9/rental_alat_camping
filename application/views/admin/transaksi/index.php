<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Transaksi - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #ecf0f1; }
        .topbar { background: #2c3e50; color: #fff; padding: 15px 30px; }
        .topbar a { color: #fff; text-decoration: none; }
        .content { padding: 40px; max-width: 1000px; margin: 0 auto; }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        .trx { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 18px; }
        .trx-head { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px; }
        .penyewa { font-weight: bold; color: #2c3e50; }
        .tanggal { color: #777; font-size: 13px; }
        .status { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .status.pending { background: #fef3cd; color: #856404; }
        .status.disewa { background: #cce5ff; color: #004085; }
        .status.selesai { background: #d4edda; color: #155724; }
        .status.dibatalkan { background: #f8d7da; color: #721c24; }
        .item { font-size: 14px; color: #444; padding: 3px 0; }
        .footer { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
        .total { font-weight: bold; color: #27ae60; font-size: 16px; }
        select { padding: 6px; border-radius: 4px; border: 1px solid #ccc; }
        button { padding: 6px 14px; background: #2980b9; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .kosong { background: #fff; padding: 40px; text-align: center; border-radius: 10px; color: #888; }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="<?= base_url('index.php/admin/dashboard') ?>">← Dashboard</a>
    </div>
    <div class="content">
        <h1>Kelola Transaksi</h1>

        <?php if (empty($transaksi)): ?>
            <div class="kosong">Belum ada transaksi masuk.</div>
        <?php else: ?>
            <?php foreach ($transaksi as $t): ?>
            <div class="trx">
                <div class="trx-head">
                    <div>
                        <div class="penyewa"><?= $t->nama_penyewa ?></div>
                        <div class="tanggal"><?= date('d M Y', strtotime($t->tanggal_sewa)) ?> &rarr; <?= date('d M Y', strtotime($t->tanggal_kembali)) ?></div>
                    </div>
                    <span class="status <?= $t->status ?>"><?= ucfirst($t->status) ?></span>
                </div>
                <?php foreach ($t->detail as $d): ?>
                    <div class="item"><?= $d->nama_alat ?> &times; <?= $d->jumlah ?> unit (<?= $d->durasi ?> hari)</div>
                <?php endforeach; ?>
                <div class="footer">
                    <span class="total">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></span>
                    <form action="<?= base_url('index.php/admin/transaksi/ubah_status/'.$t->id) ?>" method="post" style="display:flex; gap:8px;">
                        <select name="status">
                            <option value="pending" <?= $t->status=='pending'?'selected':'' ?>>Pending</option>
                            <option value="disewa" <?= $t->status=='disewa'?'selected':'' ?>>Disewa</option>
                            <option value="selesai" <?= $t->status=='selesai'?'selected':'' ?>>Selesai</option>
                            <option value="dibatalkan" <?= $t->status=='dibatalkan'?'selected':'' ?>>Dibatalkan</option>
                        </select>
                        <button type="submit">Ubah</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>