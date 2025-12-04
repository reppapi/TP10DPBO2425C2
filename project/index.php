<?php
// Memuat semua ViewModel agar logika bisnis setiap entitas bisa diakses
require_once 'viewmodels/JenisViewModel.php';
require_once 'viewmodels/MobilViewModel.php';
require_once 'viewmodels/PenyewaViewModel.php';
require_once 'viewmodels/TransaksiViewModel.php';

// Menangkap parameter dari URL untuk menentukan halaman mana yang diminta user
// Jika tidak ada request khusus, default-nya akan membuka daftar jenis mobil
$entity = isset($_GET['entity']) ? $_GET['entity'] : 'jenis';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Routing untuk jenis 
if ($entity === 'jenis') {
    // Menyiapkan kontroler untuk kategori mobil
    $jenisVM = new JenisViewModel();
    
    // Mengecek aksi apa yang ingin dilakukan user
    switch ($action) {
        case 'list':
            // Mengambil data dari database lalu menampilkannya ke view tabel
            $jenisList = $jenisVM->getJenisList();
            require_once 'views/jenis_list.php';
            break;
        case 'add':
            // Membuka form kosong untuk tambah data baru
            require_once 'views/jenis_form.php';
            break;
        case 'edit':
            // Mengambil data lama berdasarkan ID, lalu menampilkannya di form untuk diedit
            $id = $_GET['id'];
            $jenis = $jenisVM->getJenisById($id);
            require_once 'views/jenis_form.php';
            break;
        case 'save':
            // Menerima input dari form tambah, simpan ke db, lalu kembali ke daftar
            $nama_jenis = $_POST['nama_jenis'];
            $jenisVM->addJenis($nama_jenis);
            header('Location: index.php?entity=jenis&action=list');
            break;
        case 'update':
            // Menerima input dari form edit, update data di db, lalu kembali ke daftar
            $id = $_GET['id'];
            $nama_jenis = $_POST['nama_jenis'];
            $jenisVM->updateJenis($id, $nama_jenis);
            header('Location: index.php?entity=jenis&action=list');
            break;
        case 'delete':
            // Menghapus data berdasarkan ID yang dipilih
            $id = $_GET['id'];
            $jenisVM->deleteJenis($id);
            header('Location: index.php?entity=jenis&action=list');
            break;
    }
} 

// Routing untuk penyewa
elseif ($entity === 'penyewa') {
    $penyewaVM = new PenyewaViewModel();

    switch ($action) {
        case 'list':
            $penyewaList = $penyewaVM->getPenyewaList();
            require_once 'views/penyewa_list.php';
            break;
        case 'add':
            require_once 'views/penyewa_form.php';
            break;
        case 'edit':
            $id = $_GET['id'];
            $penyewa = $penyewaVM->getPenyewaById($id);
            require_once 'views/penyewa_form.php';
            break;
        case 'save':
            $penyewaVM->addPenyewa($_POST['nama_penyewa'], $_POST['kontak']);
            header('Location: index.php?entity=penyewa&action=list');
            break;
        case 'update':
            $penyewaVM->updatePenyewa($_GET['id'], $_POST['nama_penyewa'], $_POST['kontak']);
            header('Location: index.php?entity=penyewa&action=list');
            break;
        case 'delete':
            $penyewaVM->deletePenyewa($_GET['id']);
            header('Location: index.php?entity=penyewa&action=list');
            break;
    }
}

// Routing untuk mobil 
elseif ($entity === 'mobil') {
    $mobilVM = new MobilViewModel();

    switch ($action) {
        case 'list':
            $mobilList = $mobilVM->getMobilList();
            require_once 'views/mobil_list.php';
            break;
        case 'add':
            // Penting: Kita perlu mengambil daftar jenis mobil dulu
            // supaya bisa ditampilkan sebagai pilihan dropdown di form
            $jenisList = $mobilVM->getJenisList(); 
            require_once 'views/mobil_form.php';
            break;
        case 'edit':
            $id = $_GET['id'];
            $mobil = $mobilVM->getMobilById($id);
            // Dropdown jenis juga wajib ada saat mode edit
            $jenisList = $mobilVM->getJenisList(); 
            require_once 'views/mobil_form.php';
            break;
        case 'save':
            $mobilVM->addMobil($_POST['nama_mobil'], $_POST['no_plat'], $_POST['harga_sewa'], $_POST['id_jenis']);
            header('Location: index.php?entity=mobil&action=list');
            break;
        case 'update':
            $mobilVM->updateMobil($_GET['id'], $_POST['nama_mobil'], $_POST['no_plat'], $_POST['harga_sewa'], $_POST['id_jenis']);
            header('Location: index.php?entity=mobil&action=list');
            break;
        case 'delete':
            $mobilVM->deleteMobil($_GET['id']);
            header('Location: index.php?entity=mobil&action=list');
            break;
    }
}

// Routing untuk transaksi 
elseif ($entity === 'transaksi') {
    $transaksiVM = new TransaksiViewModel();

    switch ($action) {
        case 'list':
            $transaksiList = $transaksiVM->getTransaksiList();
            require_once 'views/transaksi_list.php';
            break;
        case 'add':
            // Menyiapkan dua data relasi sekaligus (Mobil & Penyewa)
            // agar user bisa memilih dari dropdown saat input transaksi
            $mobilList = $transaksiVM->getMobilList();
            $penyewaList = $transaksiVM->getPenyewaList();
            require_once 'views/transaksi_form.php';
            break;
        case 'edit':
            $id = $_GET['id'];
            $transaksi = $transaksiVM->getTransaksiById($id);
            // Load ulang data dropdown agar pilihan sebelumnya terpilih otomatis
            $mobilList = $transaksiVM->getMobilList();
            $penyewaList = $transaksiVM->getPenyewaList();
            require_once 'views/transaksi_form.php';
            break;
        case 'save':
            // Menyimpan data transaksi lengkap termasuk status dan total bayar
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
            $transaksiVM->deleteTransaksi($_GET['id']);
            header('Location: index.php?entity=transaksi&action=list');
            break;
    }
}
?>