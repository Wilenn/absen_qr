<?php
include('../koneksi.php');
$result = mysqli_query($conn, "SELECT * FROM absen");
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
    header('Location: ./user.php');
  }
}
?>
<html>
<head>
  <title>Data Absensi</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<br>
<body>
<div class="container">
			<h2>Data Absensi Siswa</h2>
			<h4></h4>
				<div class="data-tables datatable-dark">
	               <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Jam Kehadiran</th>
                                                <th>Foto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rows as $data) { 
                                                  ?>
                                                <tr>
                                                <td><?= $data['nisn']; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['kelas']; ?></td>
                                                <td><?= $data['jam_kehadiran']; ?></td>
                                                <td>
                                                    <img src="../assets/foto/<?= $data['foto']; ?>" alt="" srcset="" width="80"  />
                                                </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>