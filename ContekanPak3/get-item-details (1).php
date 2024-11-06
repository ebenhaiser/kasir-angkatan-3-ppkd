<?php
require_once "../config/koneksi.php";

if (isset($_GET['id_barang'])) {
  $id_barang = (int) $_GET['id_barang'];

  $query = "SELECT qty, harga FROM barang WHERE id = $id_barang";
  $result = mysqli_query($koneksi, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $item = mysqli_fetch_assoc($result);

    // Mengembalikan hasil dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($item);
  } else {
    echo json_encode(["error" => "Item tidak ditemukan"]);
  }
} else {
  echo json_encode(["error" => "Parameter id_barang tidak ditemukan"]);
}

// Menutup koneksi
mysqli_close($koneksi);
?>
