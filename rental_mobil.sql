DROP DATABASE IF EXISTS rental_mobil;
CREATE DATABASE rental_mobil;
USE rental_mobil;

-- Tabel Jenis
CREATE TABLE jenis (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama_jenis varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Mobil
CREATE TABLE mobil (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama_mobil varchar(100) NOT NULL,
  no_plat varchar(20) NOT NULL,
  harga_sewa decimal(10,2) NOT NULL,
  id_jenis int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_jenis (id_jenis),
  CONSTRAINT fk_jenis FOREIGN KEY (id_jenis) REFERENCES jenis (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Penyewa
CREATE TABLE penyewa (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama_penyewa varchar(100) NOT NULL,
  kontak varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Transaksi 
CREATE TABLE transaksi (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_mobil int(11) NOT NULL,
  id_penyewa int(11) NOT NULL,
  tanggal_pinjam date NOT NULL,
  lama_hari int(11) NOT NULL,
  total_bayar decimal(10,2) NOT NULL,
  status enum('Dipinjam','Selesai') NOT NULL DEFAULT 'Dipinjam',
  PRIMARY KEY (id),
  KEY fk_mobil (id_mobil),
  KEY fk_penyewa (id_penyewa),
  CONSTRAINT fk_mobil FOREIGN KEY (id_mobil) REFERENCES mobil (id) ON DELETE CASCADE,
  CONSTRAINT fk_penyewa FOREIGN KEY (id_penyewa) REFERENCES penyewa (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- DATA DUMMY
INSERT INTO jenis (nama_jenis) VALUES ('MPV'), ('SUV'), ('City Car');

INSERT INTO mobil (nama_mobil, no_plat, harga_sewa, id_jenis) VALUES 
('Toyota Avanza', 'D 1234 ABC', 300000, 1),
('Pajero Sport', 'B 9999 BOS', 800000, 2),
('Honda Brio', 'D 5555 HAH', 250000, 3);

INSERT INTO penyewa (nama_penyewa, kontak) VALUES 
('Udin Petot', '08111111'), 
('Siti Badriah', '08222222');

INSERT INTO transaksi (id_mobil, id_penyewa, tanggal_pinjam, lama_hari, total_bayar, status) VALUES 
(1, 1, '2025-12-01', 2, 600000, 'Selesai'), 
(2, 2, '2025-12-04', 1, 800000, 'Dipinjam'); 