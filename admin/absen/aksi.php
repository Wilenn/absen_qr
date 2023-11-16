<?php 
include '../koneksi.php';
$id_absen = $_POST['id_absen'];
$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
date_default_timezone_set('Asia/Jakarta');


$img = $_POST['img'];
if (strpos($img, 'data:image/png;base64') === 0) {
       
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $file = '../assets/foto/'.date("YmdHis").'.png';
	   $img_name=date("YmdHis").'.png';
	   $time=date('Y-m-d H:i:s');
   
      if (file_put_contents($file, $data)) {
         echo "The canvas was saved as $file.";
		 $sql="INSERT INTO absen (nisn,nama,kelas,foto,jam_kehadiran)VALUES('$nisn','$nama','$kelas','$img_name','$time')";
		 if (mysqli_query($conn,$sql)) {
            echo "New record created successfully";
              } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
      } else {
         echo 'The canvas could not be saved.';
      }   
     
   }

?>