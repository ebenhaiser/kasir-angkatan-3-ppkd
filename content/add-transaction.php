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
    <div class="col-8">
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
                  <button class="btn btn-primary" name="add_transaction" type="submit" id="counterBtn">+</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>