<?php require_once 'views/template/header.php'; ?>

<h2>Data Transaksi Rental</h2>
<a href="index.php?entity=transaksi&action=add" class="btn btn-primary">Tambah Transaksi</a>

<table>
    <thead>
        <tr>
            <th>Mobil</th>
            <th>Penyewa</th>
            <th>Tanggal</th>
            <th>Lama</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksiList as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['nama_mobil']); ?></td>
            <td><?= htmlspecialchars($t['nama_penyewa']); ?></td>
            <td><?= $t['tanggal_pinjam']; ?></td>
            <td><?= $t['lama_hari']; ?> Hari</td>
            <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.'); ?></td>
            <td>
                <?php if($t['status'] == 'Dipinjam'): ?>
                    <span style="color:red; font-weight:bold;">Dipinjam</span>
                <?php else: ?>
                    <span style="color:green; font-weight:bold;">Selesai</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="index.php?entity=transaksi&action=edit&id=<?= $t['id']; ?>" class="btn">Edit</a>
                <a href="index.php?entity=transaksi&action=delete&id=<?= $t['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus transaksi ini?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/template/footer.php'; ?>