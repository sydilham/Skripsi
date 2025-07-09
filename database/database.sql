CREATE TABLE perusahaan (
    id_perusahaan INT PRIMARY KEY AUTO_INCREMENT,
    nama_perusahaan VARCHAR(100) NOT NULL,
    npwp_perusahaan VARCHAR(20) UNIQUE NOT NULL,
    alamat TEXT NOT NULL,
    kontak VARCHAR(20) NOT NULL
);

CREATE TABLE pajak_karyawan (
    id_data INT PRIMARY KEY AUTO_INCREMENT,
    id_perusahaan INT NOT NULL,
    npwp VARCHAR(20) UNIQUE NOT NULL,
    nama_karyawan VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_pembayaran DATE NOT NULL,
    penghasilan DECIMAL(15,2) NOT NULL,
    pajak_terpotong DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (id_perusahaan) REFERENCES perusahaan(id_perusahaan) ON DELETE CASCADE
);

CREATE TABLE jenis_pajak (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    jenis_kategori VARCHAR(50) NOT NULL,
    tarif_pajak DECIMAL(5,2) NOT NULL
);

CREATE TABLE lapor_pajak (
    id_laporan INT PRIMARY KEY AUTO_INCREMENT,
    id_data INT NOT NULL,
    id_kategori INT NOT NULL,
    potongan DECIMAL(15,2) NOT NULL,
    total_penghasilan DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (id_data) REFERENCES pajak_karyawan(id_data) ON DELETE CASCADE,
    FOREIGN KEY (id_kategori) REFERENCES jenis_pajak(id_kategori) ON DELETE CASCADE
);

CREATE TABLE users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_perusahaan INT NULL,
    FOREIGN KEY (id_perusahaan) REFERENCES perusahaan(id_perusahaan) ON DELETE SET NULL
);
