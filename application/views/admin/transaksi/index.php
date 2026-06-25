<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Admin</title>
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
        .main { flex: 1; padding: 40px; max-width: 1000px; }
        h1 { color: #fff; margin-bottom: 28px; }
        .trx { background: #1a2942; padding: 22px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.25); margin-bottom: 18px; border: 1px solid rgba(255,255,255,0.05); }
        .trx-head { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.06); padding-bottom: 12px; margin-bottom: 12px; }
        .penyewa { font-weight: 600; color: #fff; font-size: 15px; }
        .tanggal { color: #9fb3c8; font-size: 13px; margin-top: 3px; }
        .status { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status.pending { background: rgba(241,196,15,0.15); color: #f1c40f; }
        .status.disewa { background: rgba(52,152,219,0.15); color: #3498db; }
        .status.selesai { background: rgba(46,204,113,0.15); color: #2ecc71; }
        .status.dibatalkan { background: rgba(231,76,60,0.15); color: #e74c3c; }
        .item { font-size: 14px; color: #cfd8e3; padding: 3px 0; }
        .footer { display: flex; justify-content: space-between; align-items: center; margin-top: 14px; }
        .total { font-weight: 700; color: #2ecc71; font-size: 18px; }
        select { padding: 8px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1); background: #0f1c2e; color: #e8edf2; }
        button { padding: 8px 16px; background: #2980b9; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; }
        button:hover { background: #2471a3; }
        .kosong { background: #1a2942; padding: 40px; text-align: center; border-radius: 12px; color: #9fb3c8; }
    </style>
</head>
<body>
    <div class="layout">
        <div class="sidebar">
            <div class="brand">🏕️ Admin Panel</div>
            <div class="menu">
                <a href="<?= base_url('index.php/admin/dashboard') ?>">📊 Dashboard</a>
                <a href="<?= base_url('index.php/admin/alat') ?>">📦 Kelola Alat</a>
                <a href="<?= base_url('index.php/admin/transaksi') ?>" class="active">🧾 Kelola Transaksi</a>
            </div>
            <div class="logout">
                <a href="<?= base_url('index.php/admin/auth/logout') ?>">Logout</a>
            </div>
        </div>
        <div class="main">
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
    </div>
</body>
</html>