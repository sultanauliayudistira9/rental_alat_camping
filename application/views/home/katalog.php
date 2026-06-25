<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Alat Camping</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { background: #0f1c2e; color: #e8edf2; }

        /* navbar */
        .navbar { background: rgba(15,28,46,0.95); backdrop-filter: blur(8px); padding: 16px 50px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .navbar h2 { font-size: 20px; color: #fff; }
        .navbar .nav-right { display: flex; align-items: center; gap: 18px; }
        .navbar span { font-size: 14px; color: #9fb3c8; }
        .navbar a { color: #e8edf2; text-decoration: none; font-size: 14px; transition: color 0.2s; }
        .navbar a:hover { color: #2ecc71; }
        .navbar .btn-nav { background: #2ecc71; color: #0f1c2e; padding: 8px 18px; border-radius: 6px; font-weight: 600; }
        .navbar .btn-nav:hover { background: #27ae60; color: #fff; }

        /* hero */
        .hero { background: linear-gradient(135deg, #134e5e 0%, #71b280 100%); padding: 80px 40px; text-align: center; position: relative; }
        .hero h1 { font-size: 42px; color: #fff; margin-bottom: 14px; font-weight: 700; }
        .hero p { font-size: 18px; color: rgba(255,255,255,0.9); }

        /* container */
        .container { padding: 50px 40px; max-width: 1200px; margin: 0 auto; }
        .section-title { font-size: 26px; color: #fff; margin-bottom: 6px; }
        .section-sub { color: #9fb3c8; margin-bottom: 30px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(270px, 1fr)); gap: 28px; }

        /* card */
        .card { background: #1a2942; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.3); transition: transform 0.25s, box-shadow 0.25s; border: 1px solid rgba(255,255,255,0.05); }
        .card:hover { transform: translateY(-8px); box-shadow: 0 16px 40px rgba(46,204,113,0.15); }
        .card-img-wrap { position: relative; height: 200px; overflow: hidden; }
        .card-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .card:hover .card-img { transform: scale(1.08); }
        .card-noimg { width: 100%; height: 100%; background: #243650; display: flex; align-items: center; justify-content: center; color: #5a7290; font-size: 14px; }
        .badge-stok { position: absolute; top: 12px; right: 12px; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-ada { background: #2ecc71; color: #0f1c2e; }
        .badge-habis { background: #e74c3c; color: #fff; }
        .card-body { padding: 22px; }
        .kategori { display: inline-block; background: rgba(46,204,113,0.15); color: #2ecc71; padding: 4px 12px; border-radius: 20px; font-size: 12px; margin-bottom: 12px; font-weight: 600; }
        .card h3 { color: #fff; margin-bottom: 8px; font-size: 18px; }
        .desc { color: #9fb3c8; font-size: 14px; margin-bottom: 16px; min-height: 40px; line-height: 1.5; }
        .price-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .harga { color: #2ecc71; font-size: 24px; font-weight: 700; }
        .harga small { font-size: 13px; color: #9fb3c8; font-weight: 400; }
        .stok-text { color: #9fb3c8; font-size: 13px; }
        .btn-sewa { display: block; text-align: center; background: #2ecc71; color: #0f1c2e; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.2s; }
        .btn-sewa:hover { background: #27ae60; color: #fff; }
        .btn-habis { display: block; text-align: center; background: #34495e; color: #7f8c9d; padding: 12px; border-radius: 8px; text-decoration: none; cursor: not-allowed; }

        /* footer */
        footer { background: #0a1422; padding: 30px 40px; text-align: center; color: #5a7290; font-size: 14px; margin-top: 40px; border-top: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>🏕️ Rental Alat Camping</h2>
        <div class="nav-right">
            <?php if ($this->session->userdata('role') === 'penyewa'): ?>
                <span>Halo, <?= $this->session->userdata('nama') ?>!</span>
                <a href="<?= base_url('index.php/sewa/riwayat') ?>">Sewa Saya</a>
                <a href="<?= base_url('index.php/auth/logout') ?>">Logout</a>
            <?php else: ?>
                <a href="<?= base_url('index.php/auth/login') ?>">Login</a>
                <a href="<?= base_url('index.php/auth/register') ?>" class="btn-nav">Daftar</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero">
        <h1>Sewa Alat Camping Berkualitas</h1>
        <p>Petualangan seru tanpa ribet beli peralatan</p>
    </div>

    <div class="container">
        <h2 class="section-title">Katalog Alat</h2>
        <p class="section-sub">Pilih alat yang kamu butuhkan untuk petualangan berikutnya</p>

        <div class="grid">
            <?php foreach ($alat as $a): ?>
            <div class="card">
                <div class="card-img-wrap">
                    <?php if ($a->gambar): ?>
                        <img class="card-img" src="<?= base_url('uploads/'.$a->gambar) ?>" alt="<?= $a->nama_alat ?>">
                    <?php else: ?>
                        <div class="card-noimg">Tidak ada foto</div>
                    <?php endif; ?>
                    <?php if ($a->stok > 0): ?>
                        <span class="badge-stok badge-ada">Tersedia</span>
                    <?php else: ?>
                        <span class="badge-stok badge-habis">Habis</span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <span class="kategori"><?= $a->nama_kategori ?></span>
                    <h3><?= $a->nama_alat ?></h3>
                    <p class="desc"><?= $a->deskripsi ?></p>
                    <div class="price-row">
                        <span class="harga">Rp <?= number_format($a->harga_sewa, 0, ',', '.') ?><small>/hari</small></span>
                        <span class="stok-text">Stok: <?= $a->stok ?></span>
                    </div>
                    <?php if ($a->stok > 0): ?>
                        <a href="<?= base_url('index.php/sewa/alat/'.$a->id) ?>" class="btn-sewa">Sewa Sekarang</a>
                    <?php else: ?>
                        <span class="btn-habis">Stok Habis</span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        © 2026 Rental Alat Camping · Dibuat dengan CodeIgniter 3
    </footer>
</body>
</html>