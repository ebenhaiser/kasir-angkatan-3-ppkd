<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #bee1fa;">
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- ms-auto untuk pindah ke kanan -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="kasir.php">Kasir</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <span><?php echo $_SESSION['NAMALENGKAPNYA'] . ","; ?> </span>
                    <a style="display: inline;" class="nav-link" aria-current="page" href="controller/logout.php">Log-out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>