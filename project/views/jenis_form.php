<?php require_once 'views/template/header.php'; ?>

<h2><?= isset($jenis) ? 'Edit Jenis Mobil' : 'Tambah Jenis Mobil'; ?></h2>

<form action="index.php?entity=jenis&action=<?= isset($jenis) ? 'update&id=' . $jenis['id'] : 'save'; ?>" method="POST">
    <div>
        <label>Nama Jenis:</label>
        <input type="text" name="nama_jenis" value="<?= isset($jenis) ? htmlspecialchars($jenis['nama_jenis']) : ''; ?>" required>
    </div>
    <button type="submit">Simpan</button>
    <a href="index.php?entity=jenis&action=list" class="btn" style="background:#ccc; text-decoration:none; display:inline-block; margin-top:15px;">Batal</a>
</form>

<?php require_once 'views/template/footer.php'; ?>