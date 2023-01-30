<?php

include "core/Helper.php";
include "core/Database.php";

if (!$_SESSION['user']) header('Location: login.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>App Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        /* .nav > a,
            .sb-nav-link-icon {
                color: whitesmoke !important;
            } */
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">MY ADMIN</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div> -->
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                    <span style="text-transform: capitalize;"><?php echo $_SESSION['user']['fullname']; ?> </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Karyawan</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Data Karyawan
                        </a>
                        <a class="nav-link" href="index.php?view=dataGaji">
                            <div class="sb-nav-link-icon"><i class="fas far fa-chart-bar"></i></div>
                            Data Gaji
                        </a>
                        <a class="nav-link" href="index.php?view=dataLembur">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Lembur
                        </a>
                        <?php if ($_SESSION['user']['level'] == 'admin') : ?>
                            <a class="nav-link" href="index.php?view=dataPresensi">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Data Presensi
                            </a>
                        <?php endif; ?>

                        <a class="nav-link" href="index.php?view=cetakSlipGaji">
                            <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                            Cetak Slip Gaji
                        </a>
                        <?php if ($_SESSION['user']['level'] == 'admin') : ?>
                            <hr class="divider">
                            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php?view=gajiPerbulan">Gaji Perbulan</a>
                                    <a class="nav-link" href="index.php?view=lemburPerbulan">Lembur Perbulan</a>
                                    <a class="nav-link" href="index.php?view=laporanTahunan">Tahunan</a>
                                    <a class="nav-link" href="index.php?view=pembayaranGaji">Pembayaran Gaji</a>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <strong style="text-transform: capitalize; color: white; font-size: 1.5rem"><?php echo $_SESSION['user']['level']; ?></strong>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php
                    if ($_GET) {
                        $v = @$_GET['view'];

                        if ($v == 'dataGaji')            renderView('data_gaji');
                        else if ($v == 'dataLembur')     renderView('data_lembur');
                        else if ($v == 'dataPresensi')   renderView('data_presensi');
                        else if ($v == 'cetakSlipGaji')  renderView('cetak_slip_gaji');
                        else if ($v == 'gajiPerbulan')   renderView('gaji_perbulan');
                        else if ($v == 'lemburPerbulan') renderView('lembur_perbulan');
                        else if ($v == 'laporanTahunan') renderView('laporan_tahunan');
                        else if ($v == 'pembayaranGaji') renderView('pembayaran_gaji');
                        else if ($v == 'edit')           renderView('edit');
                        else if ($v == 'edit-gaji')      renderView('edit-gaji');
                        else if ($v == "") {
                            renderView('dashboard');
                        }
                    } else {
                        renderView('dashboard');
                    }
                    ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/custom.js"></script>
    <script>
        // STATUS INTERNET
        function showStatus(online) {

            if (!online) {
                // window.removeEventListener('load');
                window.location = 'views/template/401.html';
            }
        }

        window.addEventListener('load', () => {
            navigator.onLine ? showStatus(true) : showStatus(false);
        });
    </script>
</body>

</html>