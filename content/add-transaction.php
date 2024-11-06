<?php
date_default_timezone_set("Asia/Jakarta");
$currentDate = date("Y-m-d"); 

function generateTransactionCode(){
  $transactionCode = "TR-".date("YmdHis");

  return $transactionCode;
};

if(empty($_SESSION['click_count'])){
  $_SESSION['click_count'] = 0;
};

?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div>
      <div class="card shadow">
        <div class="card-header">
          <h3 class="text-center mt-2 mb-2">Add Transaction</h3>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <div class="row">
              <div class="col-sm-6 mb-3">
                <label for="" class="form-label">Transaction Code</label>
                <input type="text" class="form-control" name="transaction_code" id="transaction_code"
                  placeholder="Insert Transaction Number" value="<?= generateTransactionCode();  ?>" readonly>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="" class="form-label">Transaction Date</label>
                <input type="date" class="form-control" name="transaction_date" id="transaction_date"
                  placeholder="Insert Transaction Date" value="<?= $currentDate ?>" readonly>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="" class="form-label">Quantity of Item</label>
                <div class="d-flex grid gap-2">
                  <input type="number" class="form-control" name="countDisplay" id="countDisplay"
                    placeholder="Insert Quantity of Item" value="<?= $_SESSION['click_count'] ?>" readonly>
                  <button class="btn btn-outline-primary" name="add_transaction" id="counterBtn">+</button>
                </div>
              </div>
            </div>
            <div class="table table-responsive">
              <table class="table table-striped table-hover table-bordered mt-3">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Remaining Stock</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr>
                    <!-- data produk ditambah  -->
                  </tr>
                </tbody>
                <tfoot align="center">
                  <tr>
                    <th colspan="5">Total Price</th>
                    <td>
                      <input type="number" id="total_price" name="total_price" class="form-control"
                        style="border: none;" readonly>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="5">Amount Paid</th>
                    <td>
                      <input type="number" id="amount_paid" name="amount_paid" class="form-control"
                        style="border: none;" required>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="5">Change</th>
                    <td>
                      <input type="number" id="amount_change" name="amount_change" class="form-control"
                        style="border: none;" readonly>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary" name="save" value="Count">
              <a href="?pg=cashier" class="btn btn-danger" id="back">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$queryCategories = mysqli_query($connection, "SELECT * FROM product_categories");
$categories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const button = document.getElementById('counterBtn');
  const countDisplay = document.getElementById('countDisplay');
  const tbody = document.getElementById('tbody');

  button.addEventListener('click', function() {
    let currentCount = parseInt(countDisplay.value) || 0;
    currentCount++;
    countDisplay.value = currentCount;

    // fungsi tambah td
    let newRow = "<tr>";

    // Nomor Tabel
    newRow += "<td>" + currentCount + "</td>";

    // Selector Category
    newRow += "<td>";
    newRow +=
      "<select class='form-control category-select' style='border: none;' name='id_category[]' id='idCategory'>";
    newRow += "<option value=''> -- Choose Categories -- </option>";
    <?php foreach ($categories as $category) : ?>
    newRow +=
      "<option value='<?= $category['id']; ?>'><?= $category['category_name']; ?></option>";
    <?php endforeach; ?>
    newRow += "</select></td>";
    // End Selector Category

    // Selector Product
    newRow += "<td>";
    newRow +=
      "<select class='form-control product-select' style='border: none;' name='id_product[]' id='idProduct'>";
    newRow += "<option value=''> -- Choose Product -- </option>";
    newRow += "</select></td>";
    // End Selector Product

    // Quantity
    newRow +=
      "<td><input type='number' class='form-control' style='border: none;' name='quantity[]' id='quantity'></td>";
    // End Quantity

    // Remaining Stock
    newRow +=
      "<td><input type='text' class='form-control' style='border: none;' name='remaining_stock[]' id='remaining_stock' readonly></td>"
    // End Remaining Stock

    // Price
    newRow +=
      "<td><input type='text' class='form-control' style='border: none;' name='price[]' id='price'></td>";
    // End Price

    newRow += "</tr>";

    tbody.insertAdjacentHTML('beforeend', newRow);
  })

  const totalPrice = document.getElementById('total_price');
  const amountChange = document.getElementById('amount_change');
  const amountPaid = document.getElementById('amount_paid');

  amountPaid.addEventListener('input', function() {
    const total = parseInt(totalPrice.value) || 0;
    const paid = parseInt(amountPaid.value) || 0;
    const change = paid - total;
    amountChange.value = change;
  });
})
</script>