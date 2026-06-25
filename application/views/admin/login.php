<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Rental Alat Camping</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #2c3e50; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .box { background: #fff; padding: 40px; border-radius: 10px; width: 360px; box-shadow: 0 5px 20px rgba(0,0,0,0.3); }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 25px; }
        label { display: block; margin-bottom: 6px; color: #555; font-size: 14px; }
        input { width: 100%; padding: 10px; margin-bottom: 18px; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #27ae60; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        button:hover { background: #219150; }
        .error { background: #ffe0e0; color: #c0392b; padding: 10px; border-radius: 5px; margin-bottom: 18px; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login Admin</h2>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="error"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/admin/auth/proses') ?>" method="post">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>