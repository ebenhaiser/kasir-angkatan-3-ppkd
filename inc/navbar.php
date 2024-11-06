<style>
.nav-link-active {
  font-weight: 700;
}
</style>

<div class="menu border-bottom border-black">
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark-subtle shadow">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link<?= isset($_GET['pg']) && $_GET['pg'] == 'dashboard' ? ' nav-link-active' : '' ?>"
              href="?pg=dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isset($_GET['pg']) && $_GET['pg'] == 'cashier' && $_GET['pg'] == 'add-transaction' ? 'nav-link-active' : '' ?>"
              href="?pg=cashier">Cashier</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Profile</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="btn btn-danger" href="controller/action-logout.php">keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>