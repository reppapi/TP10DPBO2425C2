<?php require_once 'views/template/header.php'; ?>

<h2><?= isset($mobil) ? 'Edit Mobil' : 'Tambah Mobil'; ?></h2>

<form action="index.php?entity=mobil&action=<?= isset($mobil) ? 'update&id=' . $mobil['id'] : 'save'; ?>" method="POST">
    <div>
        <label>Nama Mobil:</label>
        <input type="text" name="nama_mobil" value="<?= isset($mobil) ? htmlspecialchars($mobil['nama_mobil']) : ''; ?>" required>
    </div>
    <div>
        <label>No Plat:</label>
        <input type="text" name="no_plat" value="<?= isset($mobil) ? htmlspecialchars($mobil['no_plat']) : ''; ?>" required>
    </div>
    <div>
        <label>Harga Sewa (per hari):</label>
        <input type="number" name="harga_sewa" value="<?= isset($mobil) ? htmlspecialchars($mobil['harga_sewa']) : ''; ?>" required>
    </div>
    <div>
        <label>Jenis Mobil:</label>
        <select name="id_jenis" required>
            <option value="">-- Pilih Jenis --</option>
            <?php foreach ($jenisList as $j): ?>
                <option value="<?= $j['id']; ?>" <?= (isset($mobil) && $mobil['id_jenis'] == $j['id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($j['nama_jenis']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit">Simpan</button>
    <a href="index.php?entity=mobil&action=list" class="btn" style="background:#ccc; text-decoration:none; display:inline-block; margin-top:15px;">Batal</a>
</form>

<?php require_once 'views/template/footer.php'; ?>