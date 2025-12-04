<?php require_once 'views/template/header.php'; ?>

<h2><?= isset($penyewa) ? 'Edit Penyewa' : 'Tambah Penyewa'; ?></h2>

<form action="index.php?entity=penyewa&action=<?= isset($penyewa) ? 'update&id=' . $penyewa['id'] : 'save'; ?>" method="POST">
    <div>
        <label>Nama Penyewa:</label>
        <input type="text" name="nama_penyewa" value="<?= isset($penyewa) ? htmlspecialchars($penyewa['nama_penyewa']) : ''; ?>" required>
    </div>
    <div>
        <label>Kontak (HP/Email):</label>
        <input type="text" name="kontak" value="<?= isset($penyewa) ? htmlspecialchars($penyewa['kontak']) : ''; ?>" required>
    </div>
    <button type="submit">Simpan</button>
    <a href="index.php?entity=penyewa&action=list" class="btn" style="background:#ccc; text-decoration:none; display:inline-block; margin-top:15px;">Batal</a>
</form>

<?php require_once 'views/template/footer.php'; ?>