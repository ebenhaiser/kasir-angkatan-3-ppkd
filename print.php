<?php
include 'config/koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$queryTabelPenjualan = mysqli_query($koneksi, "SELECT barang.nama_barang, detail_penjualan.* FROM detail_penjualan LEFT JOIN BARANG ON barang.id=detail_penjualan.id_barang WHERE detail_penjualan.id_penjualan = '$id' ORDER BY id ASC");

$queryKodeTransaksi = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id = '$id'");
$rowKodeTransaksi = mysqli_fetch_assoc($queryKodeTransaksi);

$queryPembayaran = mysqli_query($koneksi, "SELECT * FROM detail_penjualan WHERE id_penjualan = '$id' LIMIT 1");
$rowPembayaran = mysqli_fetch_assoc($queryPembayaran);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Transaksi</title>
  <style>
  body {
    margin: 20px;
  }

  .struct {
    width: 80mm;
    max-width: 100%;
    border: solid 1px #000;
    padding: 10px;
    margin: 0 auto;
  }

  .struct-header,
  .struct-footer {
    text-align: center;
    margin-botttom: 10px;
  }

  .struct-body h1 {
    font-size: 18px;
    margin: 0;
  }

  .struct-body {
    margin-bottom: 10px;
    border-bottom: 1px solid #000;

  }

  .struct-body table {
    border-collapse: collapse;
    width: 100%;
  }

  .struct-body table th,
  .struct-body table td {
    padding: 5px;
    text-align: left;
  }

  .struct-body table th {
    border-bottom: 1px solid #000;
  }

  .total,
  .payment,
  .change {
    display: flex;
    justify-content: space-evenly;
    padding: 5px 0;
    font-weight: bold;
  }

  .total {
    margin-top: 10px;
    border-top: 1px solid #000;
  }

  @media print {
    body {
      margin: 0;
      padding: 0;
    }

    .struct {
      width: auto;
      border: none;
      margin: 0;
      padding: 0;
    }

    .struct-header h1,
    .struct-footer {
      font-size: 14px;
    }

    .total,
    .payment,
    .change {
      padding: 2px 0;
    }
  }
  </style>
</head>

<body>
  <div class="row">
    <div class="col-sm-6">
    </div>
    <div class="col-sm-6"></div>
  </div>
  <div class="struct">
    <div class="struct-header">
      <h1>Toko Anti Kiamat</h1>
      <p>Jl. Doang Jadian Kagak</p>
      <p>081808180818</p>
    </div>
    <br>
    <div class="struct-body">
      <p style="font-size: 12px;">Kode Transaksi: <?= $rowKodeTransaksi['kode_transaksi'] ?></p>
      <table>
        <thead>
          <th>Produk</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Sub Total</th>
        </thead>
        <tbody>
          <?php while($rowPenjualan= mysqli_fetch_assoc($queryTabelPenjualan)) : ?>
          <tr>
            <td><?= $rowPenjualan['nama_barang'] ?></td>
            <td><?= $rowPenjualan['jumlah'] ?></td>
            <td><?= "Rp. " . number_format($rowPenjualan['harga'], 2) ?></td>
            <td><?= "Rp. " . number_format($rowPenjualan['sub_total'], 2) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <div class="total">
        <span>Total :</span>
        <span><?= "Rp. " . number_format($rowPembayaran['total_harga'], 2) ?></span>
      </div>
      <div class="payment">
        <span>Bayar :</span>
        <span><?= "Rp. " . number_format($rowPembayaran['nominal_bayar'], 2) ?></span>
      </div>
      <div class="change">
        <span>Kembali :</span>
        <span><?= "Rp. " . number_format($rowPembayaran['kembalian'], 2) ?></span>
      </div>
    </div>
    <br>
    <div class="struct-footer">
      <p>Terima Kasih Atas Kunjungan Anda!</p>
      <p><i>"Empat Sehat Lima Sekarat"</i></p>
    </div>
  </div>

  <script>
  window.onload = function printPage() {
    window.print();
  }
  </script>
</body>

</html>