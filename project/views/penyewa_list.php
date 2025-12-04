<?php require_once 'views/template/header.php'; ?>

<h2>Data Penyewa</h2>
<a href="index.php?entity=penyewa&action=add" class="btn btn-primary">Tambah Penyewa</a>

<table>
    <thead>
        <tr>
            <th>Nama Penyewa</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($penyewaList as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nama_penyewa']); ?></td>
            <td><?= htmlspecialchars($p['kontak']); ?></td>
            <td>
                <a href="index.php?entity=penyewa&action=edit&id=<?= $p['id']; ?>" class="btn">Edit</a>
                <a href="index.php?entity=penyewa&action=delete&id=<?= $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>