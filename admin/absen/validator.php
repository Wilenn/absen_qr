<?php
include('../../koneksi.php');
$result = mysqli_query($koneksi, "SELECT * FROM absen");
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

session_start();
if (!isset($_SESSION['sebagai'])) {
    header("Location: ../index.php");
}

if (isset($_SESSION['sebagai'])) {
    if ($_SESSION['sebagai'] == 'user') {
        header('Location: ../user/index.php');
    }
}

if (isset($_POST['submit'])) {
    $index = $_POST['nisn'];

    $capture_time = $_POST['time_val'];

    $capture_date = $_POST['date_val'];

    $validation = "Validation";

    $nama = "nama";

    $faculty = "school-of-ict";

    $sql = "SELECT * FROM siswa WHERE nisn = '$index';";

    $stmt = $koneksi->prepare($sql);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows() > 0) {
        $validation = "User Validated Successfully";

        $data_select = "SELECT nama, kelas FROM siswa WHERE nisn = '$index';";

        $stmt = $koneksi->prepare($data_select);

        $stmt->execute();

        $stmt->bind_result($nama, $faculty);

        $stmt->fetch();
    } else {
        $validation = "User Validation Failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kelola Data Tamu</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div>
                    <img src="../assets/img/madep.png" alt="logo" width="45px">
                </div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#booking" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Data</span>
                </a>
                <div id="booking" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../siswa/index.php">Siswa</a>
                        <a class="collapse-item" href="../akun/index.php">Akun</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Absensi</span>
                </a>
                <div id="data" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php">History</a>
                        <a class="collapse-item active" href="input.php">Absen</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">



            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama']; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a href="../login/logout.php" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                    </div>
                    <div class="card text-center">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $validation ?></h5>
                            <p class="card-text">all information from our primary database If there is a problem, contact the administrator</p>
                            <p style="font-size: 14px;" class="card-text">Nama Siswa: <?php echo $nama ?></span></p>
                            <p style="font-size: 14px;" class="card-text">Kelas: <?php echo $faculty ?></span></p>
                            <p style="font-size: 14px;" class="card-text">Date : <?php echo $capture_date ?></span></p>
                            <p style="font-size: 14px;" class="card-text">Capture Time : <?php echo $capture_time ?></span></p>
                            <a href="index.php" class="btn btn-primary">Go Scanner Page</a>
                        </div>
                        <div class="card-footer text-muted">
                            
                        </div>
                    </div>

                </div>
                <!-- End of Main Content -->


            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            <!-- Bootstrap core JavaScript-->
            <script src="../assets/vendor/jquery/jquery.min.js"></script>
            <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../assets/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../assets/vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../assets/js/demo/chart-area-demo.js"></script>
            <script src="../assets/js/demo/chart-pie-demo.js"></script>

            <!-- Page level plugins -->
            <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../assets/js/demo/datatables-demo.js"></script>


</body>

</html>