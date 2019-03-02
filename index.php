<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD Procedural | MASDZIK.COM</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="author" content="MASDZIK.COM">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- <link href="assets/css/sb-admin-2.css" rel="stylesheet"> -->
    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
	<h3 align="center">CRUD DENGAN MYSQLI / PROCEDURAL | MASDZIK.COM</h3>
	<div class="table-responsive">
		<table class="table table-hover table-condensed" style="margin-top: 50px;">
			<tr>
				<th>No</th>
				<th>Nama Mahasiswa</th>
				<th>Jurusan</th>
				<th>Foto Profil</th>
				<th>Alamat Mahasiswa</th>
				<th>Action</th>
			</tr>
			<tbody>
				<tr>
				<?php 
				$no = 1;
				$data = mysqli_query($conn,"SELECT*FROM mahasiswa");
				if (!mysqli_num_rows($data)) { // Jika tidak ada data pada tabel
					echo "<td colspan='6' style='text-align:center;font-style:italic;'>Tidak ada data</td>";
				}else{
						foreach ($data as $mhs): // Menampilkan data dengan foreach ?>
					<td><?= $no++; ?></td>
					<td><?= $mhs['nama']; ?></td>
					<td><?= $mhs['jurusan']; ?></td>
					<td><img src="assets/images/<?= $mhs["foto"]; ?>" class="img-thumbnail" width="120px" height="120px"></td>
					<td><?= $mhs['alamat']; ?></td>
					<td>
						<a href="read.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat Data</a> 
						<a href="update.php?edit=<?= $mhs['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit Data</a>
						<a href="delete.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Konfirmasi hapus data ?')"><i class="fa fa-trash"></i> Hapus Data</a>
					</td>
				</tr>
				<?php endforeach; } ?>
				<?php
				$no = 1;
				$query = mysqli_query($conn,"SELECT*FROM mahasiswa");
				while ($data = mysqli_fetch_array($query)) { // Menampilkan data dengan fetch_array atau anda juga bisa menampilkan dengan fetch_assoc ?>
				<!-- <tr>
					<td><?= $no++; ?></td>
					<td><?= $data['nama']; ?></td>
					<td><?= $data['jurusan']; ?></td>
					<td><img src="assets/images/<?= $data['foto']; ?>" class="img-thumbnail" width="150px" height="150px"></td>
					<td><?= $data['alamat']; ?></td>
					<td>
						<a href="read.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat Data</a> 
						<a href="update.php?edit=<?= $mhs['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit Data</a>
						<a href="delete.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Konfirmasi hapus data ?')"><i class="fa fa-trash"></i> Hapus Data</a>
					</td>
				</tr> -->
				<?php } ?> 
			</tbody>
		</table>
	</div>
	<a href="create.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data Mahasiswa</a>
</div>
	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
	
</html>