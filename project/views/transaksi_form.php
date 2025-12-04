<?php require_once 'views/template/header.php'; ?>

<h2><?= isset($transaksi) ? 'Edit Transaksi' : 'Tambah Transaksi Baru'; ?></h2>

<form action="index.php?entity=transaksi&action=<?= isset($transaksi) ? 'update&id=' . $transaksi['id'] : 'save'; ?>" method="POST">
    
    <div>
        <label>Pilih Mobil:</label>
        <select name="id_mobil" required>
            <option value="">-- Pilih Mobil --</option>
            <?php foreach ($mobilList as $m): ?>
                <option value="<?= $m['id']; ?>" <?= (isset($transaksi) && $transaksi['id_mobil'] == $m['id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($m['nama_mobil']); ?> (Rp <?= number_format($m['harga_sewa'],0,',','.'); ?>/hari)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Pilih Penyewa:</label>
        <select name="id_penyewa" required>
            <option value="">-- Pilih Penyewa --</option>
            <?php foreach ($penyewaList as $p): ?>
                <option value="<?= $p['id']; ?>" <?= (isset($transaksi) && $transaksi['id_penyewa'] == $p['id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($p['nama_penyewa']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Tanggal Pinjam:</label>
        <input type="date" name="tanggal_pinjam" value="<?= isset($transaksi) ? $transaksi['tanggal_pinjam'] : date('Y-m-d'); ?>" required>
    </div>

    <div>
        <label>Lama Sewa (Hari):</label>
        <input type="number" name="lama_hari" value="<?= isset($transaksi) ? $transaksi['lama_hari'] : '1'; ?>" min="1" required>
    </div>

    <div>
        <label>Total Bayar (Rp):</label>
        <input type="number" name="total_bayar" value="<?= isset($transaksi) ? $transaksi['total_bayar'] : ''; ?>" placeholder="Hitung manual: Harga x Hari" required>
    </div>

    <div>
        <label>Status:</label>
        <select name="status">
            <option value="Dipinjam" <?= (isset($transaksi) && $transaksi['status'] == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
            <option value="Selesai" <?= (isset($transaksi) && $transaksi['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai (Dikembalikan)</option>
        </select>
    </div>

    <button type="submit">Simpan Transaksi</button>
    <a href="index.php?entity=transaksi&action=list" class="btn" style="background:#ccc; text-decoration:none; display:inline-block; margin-top:15px;">Batal</a>
</form>

<?php require_once 'views/template/footer.php'; ?>