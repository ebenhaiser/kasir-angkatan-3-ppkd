<?php
session_start();
session_regenerate_id();
date_default_timezone_set('Asia/Jakarta');
require_once "config/koneksi.php";

if (empty($_SESSION['NAMA']) && empty($_SESSION['EMAIL'])) {
  header("location: index.php");
  exit();
}
if (isset($_GET['level']) && $_GET['level'] == "kasir") {
  function generateTransactionCode() {
    // Mendapatkan waktu saat ini dalam format yymmddHHMMSS
    $timeStamp = date('ymdHis');
    // echo $timeStamp;
     // Membuat angka acak 4 digit
    //  $randomNumber = mt_rand(1000, 9999);
    // // Menggabungkan bagian akhir timestamp dengan angka acak, dan memotong jika lebih dari 8 karakter
    // $transactionCode = substr($timeStamp, -4) . $randomNumber;

    // // Memastikan kode transaksi hanya memiliki 8 karakter
    return $timeStamp;

  }

  $currentDate = date('Y-m-d');

  if (empty($_SESSION['click_count'])) {
    $_SESSION['click_count'] = 0;
  }

  $kategori = mysqli_query($koneksi, "SELECT * FROM kategori_barang");
  $categories = mysqli_fetch_all($kategori, MYSQLI_ASSOC);
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once "inc/css.php";?>
  <title>Document</title>
</head>
<body>
  <?php require_once "inc/navbar.php";?>
  <div class="container justify-content-center">
    <form action="controller/kasir-transaksi-store.php" method="post">
    <div class="mb-3 row text-center">
      <div class="col-sm-2">
        <label for="kode_transaksi">No. Transaksi</label>
        <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" readonly value="<?php echo "TR-". generateTransactionCode()?>">
      </div>
      <div class="col-sm-2">
        <label for="">Tanggal Transaksi</label>
        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" readonly value="<?php echo $currentDate?>">
      </div>
      <div class="col-sm-3 d-flex align-items-end">
        <button type="button" class="btn btn-primary btn-sm btn-add mb-3" id="counterBtn">Tambah</button>
      </div>
      <div class="col-sm-3 d-flex align-items-end">
        <input type="number" class="form-control" style="width: 100px;" name="countDisplay" id="countDisplay" value="<?php echo $_SESSION['click_count']?>" readonly>
      </div>
    </div>
    <div class="table-transaction">
      <table class="table table-bordered">
        <thead class="text-center">
          <tr>
            <th>No.</th>
            <th>Nama Kategori</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Sisa Produk</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <!-- Baris baru akan ditambahkan disini -->
        </tbody>
        <tfoot class="text-center">
          <tr>
            <th colspan="5">Total Harga</th>
            <td><input type="number" id="total_harga_keseluruhan" name="total_harga" class="form-control" readonly></td>
          </tr>
          <tr>
            <th colspan="5">Nominal Bayar</th>
            <td><input type="number" id="nominal_bayar_keseluruhan" name="nominal_bayar" class="form-control" required></td>
          </tr>
          <tr>
            <th colspan="5">Kembalian</th>
            <td><input type="number" id="kembalian_keseluruhan" name="kembalian" class="form-control" readonly></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <br><br>
    <div class="mb-3">
            <input type="submit" class="btn btn-primary" name="simpan" value="Hitung">
            <a href="manage-transaction.php?level=kasir" class="btn btn-danger" id="back">Kembali</a>
        </div>
  </div>
  </form>
  <?php require_once "inc/js.php";?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // start jalankan fungsi tambah column di table
      const button = document.getElementById('counterBtn');
      const countDisplay = document.getElementById('countDisplay');
      const tbody = document.getElementById('tbody');
      // end jalankan fungsi tambah column di table
      button.addEventListener('click', function() {
        //FUNGSI count akan bertambah dari jumlah klik tambahnya
        let currentCount = parseInt(countDisplay.value) || 0;
        currentCount++;
        countDisplay.value = currentCount;
        //FUNGSI penambahan td 
        let newRow = "<tr>";
        newRow += "<td>" + currentCount + "</td>";
        newRow += "<td><select class='form-control category-select' name='id_kategori[]' required>";
        newRow += "<option value=''>--Pilih Kategori--</option>";
        <?php foreach($categories as $category){ ?>
          newRow += "<option value='<?php echo $category['id']?>'><?php echo $category['nama_kategori']?></option>";
        <?php
        }?>
        newRow += "</select></td>";
        newRow += "<td><select class='form-control item-select' name='id_barang[]' required>";
        newRow += "<option value=''>--Pilih Barang--</option>";
        newRow += "</select></td>";
        newRow += "<td><input type='number' name='jumlah[]' class='form-control jumlah-input' value='0' required></td>";
        newRow += "<td><input type='number' name='sisa_produk[]' class='form-control' readonly></td>";
        newRow += "<td><input type='number' name='harga[]' class='form-control' readonly></td>";
        newRow += "</select></td>";
        newRow += "</tr>";
        tbody.insertAdjacentHTML('beforeend', newRow);

        // Menambahkan event listener 'change' ke elemen kategori baru, pilih item, input jumlah, dan input nominal bayar
        attachCategoryChangeListener();
        attachItemChangeListener();
        attachJumlahChangeListener();
      });
      function attachCategoryChangeListener() {
        const categorySelects = document.querySelectorAll('.category-select');
        categorySelects.forEach(select => {
          select.addEventListener('change', function() {
            const categoryId = this.value;
            const itemSelect = this.closest('tr').querySelector('.item-select');

            if (categoryId) {
              fetch(`controller/get-product-by-category.php?id_kategori=${categoryId}`)
              .then(response =>response.json())
              .then(data => {
                itemSelect.innerHTML = "<option value=''>--Pilih Barang--</option>";
                data.forEach(item => {
                  itemSelect.innerHTML += `<option value='${item.id}'>${item.nama_barang}</option>`;
                });
              });
            }else{
              itemSelect.innerHTML = "<option value=''>--Pilih Barang--</option>";
            }
          });
        });
      }
      function attachItemChangeListener() {
      const itemSelects = document.querySelectorAll('.item-select');
      itemSelects.forEach(select => {
        select.addEventListener('change', function() {
          const itemId = this.value;
          const row = this.closest('tr');
          const sisaProdukInput = row.querySelector('input[name="sisa_produk[]"]');
          const hargaInput = row.querySelector('input[name="harga[]"]');

          if (itemId) {
            fetch(`controller/get-item-details.php?id_barang=${itemId}`)
              .then(response => response.json())
              .then(data => {
                sisaProdukInput.value = data.qty;
                hargaInput.value = data.harga;
              })
              .catch(error => {
                console.error('Error fetching item details:', error);
              });
          } else {
            sisaProdukInput.value = '';
            hargaInput.value = '';
          }
        });
      });
    }
    const totalHargaKeseluruhanInput = document.getElementById('total_harga_keseluruhan');
    const nominalBayarKeseluruhanInput = document.getElementById('nominal_bayar_keseluruhan');
    const kembalianKeseluruhanInput = document.getElementById('kembalian_keseluruhan');

    function attachJumlahChangeListener() {
      const jumlahInputs = document.querySelectorAll('.jumlah-input');
      jumlahInputs.forEach(input => {
        input.addEventListener('input', function() {
          const row = this.closest('tr');
          const sisaProdukInput = row.querySelector('input[name="sisa_produk[]"]');
          const hargaInput = row.querySelector('input[name="harga[]"]');
          const totalHargaInput = document.getElementById('total_harga_keseluruhan');
          const nominalBayarInput = document.getElementById('nominal_bayar_keseluruhan');
          const kembalianInput = document.getElementById('kembalian_keseluruhan');

          const jumlah = parseInt(this.value) || 0;
          const sisaProduk = parseInt(sisaProdukInput.value) || 0;
          const harga = parseFloat(hargaInput.value) || 0;

          if (jumlah > sisaProduk) {
            alert('Jumlah tidak boleh melebihi sisa produk');
            this.value = sisaProduk;
            return;
          }

          //Update total harga keseluruhan
          updateTotalKeseluruhan();

          //Update kembalian
          kembalianInput.value = parseFloat(nominalBayarInput.value) - parseFloat(totalHargaKeseluruhanInput.value);
        });
      });
    }
    function updateTotalKeseluruhan(){
      let totalKeseluruhan = 0;
      const jumlahInput = document.querySelectorAll('.jumlah-input');
      jumlahInput.forEach(input => {
        const row = input.closest('tr');
        const hargaInput = row.querySelector('input[name="harga[]"]');
        const harga = parseFloat(hargaInput.value) || 0;
        const jumlah = parseInt(input.value) || 0;
        totalKeseluruhan += jumlah * harga;
      });
      totalHargaKeseluruhanInput.value = totalKeseluruhan;
    }

    //Attach event listenet ke elemen inisial
    attachCategoryChangeListener();
    attachItemChangeListener();
    attachJumlahChangeListener();

    //Event listenet untuk nominal bayar inputnya
    nominalBayarKeseluruhanInput.addEventListener('input', function() {
      const nominalBayar = parseFloat(this.value) || 0;
      const totalHarga = parseFloat(totalHargaKeseluruhanInput.value) || 0;
      kembalianKeseluruhanInput.value = nominalBayar - totalHarga;
    });
    });
  </script>
</body>
</html>