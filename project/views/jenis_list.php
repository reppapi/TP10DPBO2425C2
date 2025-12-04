<?php require_once 'views/template/header.php'; ?>

<h2>Data Jenis Mobil</h2>
<a href="index.php?entity=jenis&action=add" class="btn btn-primary">Tambah Jenis</a>

<table>
    <thead>
        <tr>
            <th>Nama Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jenisList as $jenis): ?>
        <tr>
            <td><?= htmlspecialchars($jenis['nama_jenis']); ?></td>
            <td>
                <a href="index.php?entity=jenis&action=edit&id=<?= $jenis['id']; ?>" class="btn">Edit</a>
                <a href="index.php?entity=jenis&action=delete&id=<?= $jenis['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>