<?php
// Load semua ViewModel yang dipakai untuk routing
require_once 'viewmodels/JenisViewModel.php';
require_once 'viewmodels/MobilViewModel.php';
require_once 'viewmodels/PenyewaViewModel.php';
require_once 'viewmodels/TransaksiViewModel.php';

// Ambil parameter routing dari URL, default diarahkan ke halaman jenis
$entity = isset($_GET['entity']) ? $_GET['entity'] : 'jenis';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Routing : jenis (Kategori mobil)
if ($entity === 'jenis') {
    $jenisVM = new JenisViewModel();

    switch ($action) {
        case 'list':
            // Ambil semua data jenis untuk ditampilkan
            $jenisList = $jenisVM->getJenisList();
            require_once 'views/jenis_list.php';
            break;

        case 'add':
            // Form tambah data
            require_once 'views/jenis_form.php';
            break;

        case 'edit':
            // Ambil data berdasarkan ID untuk diedit
            $id = $_GET['id'];
            $jenis = $jenisVM->getJenisById($id);
            require_once 'views/jenis_form.php';
            break;

        case 'save':
            // Proses insert data baru
            $jenisVM->addJenis($_POST['nama_jenis']);
            header('Location: index.php?entity=jenis&action=list');
            break;

        case 'update':
            // Proses update data berdasarkan ID
            $jenisVM->updateJenis($_GET['id'], $_POST['nama_jenis']);
            header('Location: index.php?entity=jenis&action=list');
            break;

        case 'delete':
            // Hapus data berdasarkan ID
            $jenisVM->deleteJenis($_GET['id']);
            header('Location: index.php?entity=jenis&action=list');
            break;
    }
}

// Routing : penyewa
elseif ($entity === 'penyewa') {
    $penyewaVM = new PenyewaViewModel();

    switch ($action) {
        case 'list':
            // Tampilkan semua penyewa
            $penyewaList = $penyewaVM->getPenyewaList();
            require_once 'views/penyewa_list.php';
            break;

        case 'add':
            // Form tambah penyewa
            require_once 'views/penyewa_form.php';
            break;

        case 'edit':
            // Ambil data penyewa untuk diedit
            $penyewa = $penyewaVM->getPenyewaById($_GET['id']);
            require_once 'views/penyewa_form.php';
            break;

        case 'save':
            // Insert data penyewa baru
            $penyewaVM->addPenyewa($_POST['nama_penyewa'], $_POST['kontak']);
            header('Location: index.php?entity=penyewa&action=list');
            break;

        case 'update':
            // Update data penyewa lama
            $penyewaVM->updatePenyewa(
                $_GET['id'],
                $_POST['nama_penyewa'],
                $_POST['kontak']
            );
            header('Location: index.php?entity=penyewa&action=list');
            break;

        case 'delete':
            // Hapus penyewa
            $penyewaVM->deletePenyewa($_GET['id']);
            header('Location: index.php?entity=penyewa&action=list');
            break;
    }
}

// Routing : mobil (pakai dropdown Jenis)
elseif ($entity === 'mobil') {
    $mobilVM = new MobilViewModel();

    switch ($action) {
        case 'list':
            // Tampilkan semua mobil
            $mobilList = $mobilVM->getMobilList();
            require_once 'views/mobil_list.php';
            break;

        case 'add':
            // Ambil list jenis buat dropdown
            $jenisList = $mobilVM->getJenisList();
            require_once 'views/mobil_form.php';
            break;

        case 'edit':
            // Ambil data mobil dan data jenis untuk dropdown saat edit
            $mobil = $mobilVM->getMobilById($_GET['id']);
            $jenisList = $mobilVM->getJenisList();
            require_once 'views/mobil_form.php';
            break;

        case 'save':
            // Insert data mobil baru
            $mobilVM->addMobil(
                $_POST['nama_mobil'],
                $_POST['no_plat'],
                $_POST['harga_sewa'],
                $_POST['id_jenis']
            );
            header('Location: index.php?entity=mobil&action=list');
            break;

        case 'update':
            // Update data mobil berdasarkan ID
            $mobilVM->updateMobil(
                $_GET['id'],
                $_POST['nama_mobil'],
                $_POST['no_plat'],
                $_POST['harga_sewa'],
                $_POST['id_jenis']
            );
            header('Location: index.php?entity=mobil&action=list');
            break;

        case 'delete':
            // Hapus mobil
            $mobilVM->deleteMobil($_GET['id']);
            header('Location: index.php?entity=mobil&action=list');
            break;
    }
}

// Routing : transaksi (pakai 2 dropdown)
elseif ($entity === 'transaksi') {
    $transaksiVM = new TransaksiViewModel();

    switch ($action) {
        case 'list':
            // List seluruh transaksi
            $transaksiList = $transaksiVM->getTransaksiList();
            require_once 'views/transaksi_list.php';
            break;

        case 'add':
            // Dropdown mobil + penyewa
            $mobilList = $transaksiVM->getMobilList();
            $penyewaList = $transaksiVM->getPenyewaList();
            require_once 'views/transaksi_form.php';
            break;

        case 'edit':
            // Ambil data transaksi + list dropdown
            $transaksi = $transaksiVM->getTransaksiById($_GET['id']);
            $mobilList = $transaksiVM->getMobilList();
            $penyewaList = $transaksiVM->getPenyewaList();
            require_once 'views/transaksi_form.php';
            break;

        case 'save':
            // Insert transaksi baru
            $transaksiVM->addTransaksi(
                $_POST['id_mobil'],
                $_POST['id_penyewa'],
                $_POST['tanggal_pinjam'],
                $_POST['lama_hari'],
                $_POST['total_bayar'],
                $_POST['status']
            );
            header('Location: index.php?entity=transaksi&action=list');
            break;

        case 'update':
            // Update transaksi lama
            $transaksiVM->updateTransaksi(
                $_GET['id'],
                $_POST['id_mobil'],
                $_POST['id_penyewa'],
                $_POST['tanggal_pinjam'],
                $_POST['lama_hari'],
                $_POST['total_bayar'],
                $_POST['status']
            );
            header('Location: index.php?entity=transaksi&action=list');
            break;

        case 'delete':
            // Hapus transaksi
            $transaksiVM->deleteTransaksi($_GET['id']);
            header('Location: index.php?entity=transaksi&action=list');
            break;
    }
}
