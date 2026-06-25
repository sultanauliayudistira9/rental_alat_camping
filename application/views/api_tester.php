<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tes REST API - Alat</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f4f6f7; padding: 30px; max-width: 800px; margin: 0 auto; }
        h1 { color: #2c3e50; }
        .box { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        h3 { margin-bottom: 12px; color: #34495e; }
        input { padding: 8px; margin: 4px 0; border: 1px solid #ccc; border-radius: 4px; width: 100%; }
        button { padding: 10px 16px; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-top: 8px; }
        .get { background: #27ae60; } .post { background: #2980b9; }
        .put { background: #e67e22; } .del { background: #c0392b; }
        pre { background: #2c3e50; color: #2ecc71; padding: 15px; border-radius: 6px; overflow-x: auto; white-space: pre-wrap; }
    </style>
</head>
<body>
    <h1>🔧 Tes REST API Alat</h1>

    <div class="box">
        <h3>GET — Lihat Semua Alat</h3>
        <button class="get" onclick="getAlat()">Ambil Data</button>
    </div>

    <div class="box">
        <h3>POST — Tambah Alat</h3>
        <input id="p_nama" placeholder="Nama alat">
        <input id="p_kategori" placeholder="Kategori ID (1-4)" type="number">
        <input id="p_harga" placeholder="Harga sewa" type="number">
        <input id="p_stok" placeholder="Stok" type="number">
        <button class="post" onclick="postAlat()">Tambah</button>
    </div>

    <div class="box">
        <h3>PUT — Edit Alat</h3>
        <input id="u_id" placeholder="ID alat yang diedit" type="number">
        <input id="u_nama" placeholder="Nama baru">
        <input id="u_harga" placeholder="Harga baru" type="number">
        <input id="u_stok" placeholder="Stok baru" type="number">
        <button class="put" onclick="putAlat()">Update</button>
    </div>

    <div class="box">
        <h3>DELETE — Hapus Alat</h3>
        <input id="d_id" placeholder="ID alat yang dihapus" type="number">
        <button class="del" onclick="deleteAlat()">Hapus</button>
    </div>

    <h3>Hasil Respon API:</h3>
    <pre id="hasil">Belum ada request...</pre>

    <script>
        const API = '<?= base_url("index.php/api/alat") ?>';
        const tampil = (data) => document.getElementById('hasil').textContent = JSON.stringify(data, null, 2);

        function getAlat() {
            fetch(API).then(r => r.json()).then(tampil).catch(e => tampil({error: e.message}));
        }

        function postAlat() {
            const fd = new FormData();
            fd.append('nama_alat', document.getElementById('p_nama').value);
            fd.append('kategori_id', document.getElementById('p_kategori').value);
            fd.append('harga_sewa', document.getElementById('p_harga').value);
            fd.append('stok', document.getElementById('p_stok').value);
            fd.append('kondisi', 'baik');
            fetch(API, { method: 'POST', body: fd }).then(r => r.json()).then(tampil).catch(e => tampil({error: e.message}));
        }

        function putAlat() {
            const params = new URLSearchParams();
            params.append('id', document.getElementById('u_id').value);
            params.append('nama_alat', document.getElementById('u_nama').value);
            params.append('harga_sewa', document.getElementById('u_harga').value);
            params.append('stok', document.getElementById('u_stok').value);
            fetch(API, { method: 'PUT', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: params }).then(r => r.json()).then(tampil).catch(e => tampil({error: e.message}));
        }

        function deleteAlat() {
            fetch(API + '?id=' + document.getElementById('d_id').value, { method: 'DELETE' }).then(r => r.json()).then(tampil).catch(e => tampil({error: e.message}));
        }
    </script>
</body>
</html>