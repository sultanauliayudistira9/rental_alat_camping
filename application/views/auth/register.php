<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Rental Alat Camping</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #27ae60; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .box { background: #fff; padding: 40px; border-radius: 10px; width: 400px; box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 25px; }
        label { display: block; margin-bottom: 6px; color: #555; font-size: 14px; }
        input { width: 100%; padding: 10px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #27ae60; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #219150; }
        .error { background: #ffe0e0; color: #c0392b; padding: 10px; border-radius: 5px; margin-bottom: 16px; font-size: 14px; text-align: center; }
        .link { text-align: center; margin-top: 16px; font-size: 14px; }
        .link a { color: #27ae60; text-decoration: none; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Daftar Akun</h2>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="error"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/simpan_register') ?>" method="post">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>No. HP</label>
            <input type="text" name="no_hp">

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Daftar</button>
        </form>
        <div class="link">Sudah punya akun? <a href="<?= base_url('index.php/auth/login') ?>">Login di sini</a></div>
    </div>
</body>
</html>