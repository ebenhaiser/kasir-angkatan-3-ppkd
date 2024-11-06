<?php
require_once "../config/koneksi.php";

if (isset($_GET['id_kategori'])) {
  $id_kategori = (int) $_GET['id_kategori'];

  $kategori = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_kategori = $id_kategori");

    // Mengambil hasil query dan menyimpannya dalam array
    $items = [];
  if ($kategori && mysqli_num_rows($kategori) > 0) {
    while($row = mysqli_fetch_assoc($kategori)){
      $items[] = $row; 
    }
  }
    // Mengembalikan hasil dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($items);
} else {
    // Pesan error jika parameter id_kategori tidak ditemukan
    echo json_encode(["error" => "Parameter id_kategori tidak ditemukan"]);
}

// Menutup koneksi
mysqli_close($koneksi);
?>