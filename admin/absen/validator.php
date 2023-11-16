<?php
include('../../koneksi.php');

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


<html>

<body>
<div class="card text-center">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $validation ?></h5>
        <p class="card-text">all information from our primary database If there is a problem, contact the administrator</p>
        <p style="font-size: 14px;" class="card-text">Nama Siswa: <span class="badge bg-primary"><?php echo $nama?></span></p>
        <p style="font-size: 14px;" class="card-text">Kelas: <span class="badge bg-primary"><?php echo $faculty?></span></p>
        <p style="font-size: 14px;" class="card-text">Date : <span class="badge bg-primary"><?php echo $capture_date?></span></p>
        <p style="font-size: 14px;" class="card-text">Capture Time : <span class="badge bg-primary"><?php echo $capture_time?></span></p>
        <a href="index.php" class="btn btn-primary">Go Scanner Page</a>
    </div>
    <div class="card-footer text-muted">
        2 days ago
    </div>
</div>
</body>

</html>


