<?php
include '../../../koneksi.php';
$nisn = $_GET['nisn'];

// Properly escape the value to prevent SQL injection
$nisn = mysqli_real_escape_string($koneksi, $nisn);

$result = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn = '$nisn'");
$cek = mysqli_affected_rows($koneksi);

if ($cek > 0) {
  echo "<script> 
          alert('BERHASIL DI MENGHAPUS');
        </script>";
  header("Location: ../index.php");
} else {
  echo "<script> 
          alert('GAGAL DI MENGHAPUS');
        </script>";
  header("Location: ../index.php");
}
?>
