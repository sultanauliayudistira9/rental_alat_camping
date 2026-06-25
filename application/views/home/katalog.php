<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Alat Camping</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f4f6f7; }
        .navbar { background: #27ae60; color: #fff; padding: 18px 40px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { font-size: 20px; }
        .navbar a { color: #fff; text-decoration: none; margin-left: 20px; font-size: 14px; }
        .navbar span { font-size: 14px; }
        .hero { background: #2c3e50; color: #fff; padding: 50px 40px; text-align: center; }
        .hero h1 { font-size: 32px; margin-bottom: 10px; }
        .container { padding: 40px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; }
        .card { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .card-body { padding: 20px; }
        .card h3 { color: #2c3e50; margin-bottom: 8px; }
        .kategori { display: inline-block; background: #ecf0f1; color: #555; padding: 3px 10px; border-radius: 12px; font-size: 12px; margin-bottom: 10px; }
        .desc { color: #777; font-size: 14px; margin-bottom: 12px; min-height: 40px; }
        .harga { color: #27ae60; font-size: 20px; font-weight: bold; }
        .stok { color: #888; font-size: 13px; margin: 8px 0; }
        .btn-sewa { display: block; text-align: center; background: #e67e22; color: #fff; padding: 10px; border-radius: 5px; text-decoration: none; margin-top: 10px; }
        .btn-sewa:hover { background: #d35400; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>🏕️ Rental Alat Camping</h2>
        <div>
            <?php if ($this->session->userdata('role') === 'penyewa'): ?>
                <span>Halo, <?= $this->session->userdata('nama') ?>!</span>
                <a href="<?= base_url('index.php/sewa/riwayat') ?>">Sewa Saya</a>
                <a href="<?= base_url('index.php/auth/logout') ?>">Logout</a>
            <?php else: ?>
                <a href="<?= base_url('index.php/auth/login') ?>">Login</a>
                <a href="<?= base_url('index.php/auth/register') ?>">Daftar</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero">
        <h1>Sewa Alat Camping Berkualitas</h1>
        <p>Petualangan seru tanpa ribet beli peralatan</p>
    </div>

    <div class="container">
        <div class="grid">
            <?php foreach ($alat as $a): ?>
            <div class="card">
                <div class="card-body">
                    <span class="kategori"><?= $a->nama_kategori ?></span>
                    <h3><?= $a->nama_alat ?></h3>
                    <p class="desc"><?= $a->deskripsi ?></p>
                    <div class="harga">Rp <?= number_format($a->harga_sewa, 0, ',', '.') ?><span style="font-size:13px; color:#888;">/hari</span></div>
                    <div class="stok">Stok: <?= $a->stok ?> unit</div>
                    <a href="<?= base_url('index.php/sewa/alat/'.$a->id) ?>" class="btn-sewa">Sewa Sekarang</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>