<?php
// Memulai sesi dan koneksi database
session_start();
require_once "../config/koneksi.php"; // Sesuaikan dengan path ke file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['EMAIL'])) {
$email = $_SESSION['EMAIL'];

$query = mysqli_query($koneksi, "SELECT id FROM users WHERE email = '$email'");
$row = mysqli_fetch_assoc($query);

// Ambil data dari input form
$id_user = $row['id']; // Ambil id_user dari session
$kode_transaksi = $_POST['kode_transaksi'];
$tanggal_transaksi = $_POST['tanggal_transaksi'];
$total_harga = $_POST['total_harga'];
$nominal_bayar = $_POST['nominal_bayar'];
$kembalian = $_POST['kembalian'];

// Simpan data transaksi utama ke tabel `transactions`
$query = "INSERT INTO penjualan (id_user, kode_transaksi, tanggal_transaksi) VALUES ('$id_user', '$kode_transaksi', '$tanggal_transaksi')";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Gagal menyimpan data transaksi: " . mysqli_error($koneksi));
}

// Ambil ID transaksi yang baru disimpan
$id_penjualan = mysqli_insert_id($koneksi);

// Simpan detail transaksi
foreach ($_POST['id_barang'] as $index => $id_barang) {
    $jumlah = $_POST['jumlah'][$index];
    
    // Ambil harga dan stok barang dari database
    $barangQuery = mysqli_query($koneksi, "SELECT harga, qty FROM barang WHERE id = $id_barang");
    $barangData = mysqli_fetch_assoc($barangQuery);

    if (!$barangData) {
        die("Barang dengan ID $id_barang tidak ditemukan.");
    }

    $harga = $barangData['harga'];
    $qty = $barangData['qty'];

    // Cek apakah jumlah yang diminta melebihi stok barang
    if ($jumlah > $qty) {
        die("Jumlah melebihi stok barang pada index $index.");
    }

    $total_harga_detail = $jumlah * $harga;

    // Simpan data ke tabel `detail_penjualan`
    $detailQuery = "INSERT INTO detail_penjualan (id_penjualan, id_barang, jumlah, qty, harga, total_harga, nominal_bayar, kembalian)
                    VALUES ('$id_penjualan', '$id_barang', '$jumlah', '$qty', '$harga', '$total_harga_detail', '$nominal_bayar', '$kembalian')";

    if (!mysqli_query($koneksi, $detailQuery)) {
        die("Gagal menyimpan detail transaksi: " . mysqli_error($koneksi));
    }

    // Kurangi stok barang
    $updateStockQuery = "UPDATE barang SET qty = qty - $jumlah WHERE id = $id_barang";
    if (!mysqli_query($koneksi, $updateStockQuery)) {
        die("Gagal memperbarui stok barang: " . mysqli_error($koneksi));
    }
}

// Redirect setelah transaksi berhasil
header("Location: ../tambah-transaction.php?level=kasir");
exit();

}
?>
