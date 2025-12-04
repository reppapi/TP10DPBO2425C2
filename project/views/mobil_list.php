<?php require_once 'views/template/header.php'; ?>

<h2>Data Mobil</h2>
<a href="index.php?entity=mobil&action=add" class="btn btn-primary">Tambah Mobil</a>

<table>
    <thead>
        <tr>
            <th>Nama Mobil</th>
            <th>No Plat</th>
            <th>Harga Sewa</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mobilList as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['nama_mobil']); ?></td>
            <td><?= htmlspecialchars($m['no_plat']); ?></td>
            <td>Rp <?= number_format($m['harga_sewa'], 0, ',', '.'); ?></td>
            <td><?= htmlspecialchars($m['nama_jenis']); ?></td>
            <td>
                <a href="index.php?entity=mobil&action=edit&id=<?= $m['id']; ?>" class="btn">Edit</a>
                <a href="index.php?entity=mobil&action=delete&id=<?= $m['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>