<?php include 'koneksi.php'; 
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$query = mysqli_query($conn,"SELECT*FROM mahasiswa WHERE id='$id'");
	$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD Procedural | MASDZIK.COM</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="author" content="MASDZIK.COM">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
	  <h3 align="center">CRUD DENGAN MYSQLI / PROCEDURAL | MASDZIK.COM</h3>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form action="" method="POST" enctype="multipart/form-data">
				  	<div class="panel panel-primary">
						<div class="panel-heading"><i class="fa fa-eye"></i> Edit Data Mahasiswa </div>
						  <div class="panel-body"> 	
						  	<div class="form-group">

						  		<input type="hidden" name="id" value="<?php echo $row['id'];?>">
						  		<input type="hidden" name="fotoLama" value="<?php echo $row['foto'];?>">

						      <label for="nama">Nama : </label>
						      <input class="form-control" id="nama" type="text" value="<?= $row['nama']; ?>" name="nama" >
						    </div>
							<div class="form-group">
						      <label for="jurusan">Jurusan : </label>
						      <?php $jurusan = $row['jurusan']; ?>
						      	<select name="jurusan" class="form-control">
							      	<option <?php echo ($jurusan == 'Teknik Kimia') ? "selected": ""?>>Teknik Kimia</option>
									<option <?php echo ($jurusan == 'Teknik Mesin') ? "selected": ""?>>Teknik Mesin</option>
									<option <?php echo ($jurusan == 'Teknik Informatika') ? "selected": ""?>>Teknik Informatika</option>
									<option <?php echo ($jurusan == 'Teknik Sipil') ? "selected": ""?>>Teknik Sipil</option>
									<option <?php echo ($jurusan == 'Teknik Elektro') ? "selected": ""?>>Teknik Elektro</option>
						      	</select>
						    </div>
							<div class="form-group">
						      <label for="foto">Foto : </label><br>
						      <img src="assets/images/<?= $row['foto'];?>" class="img-thumbnail" title="Foto Lama" width="150px" height="150px">
						      <input type="file" name="foto">
							</div>
							<div class="form-group">
						      <label for="alamat">Alamat : </label>
						      <input class="form-control" id="alamat" type="text" name="alamat" value="<?= $row['alamat']; ?>">
						    </div>
	    				 </div>
	    				 <div class="panel-footer">
	    				 	 <input type="submit" name="update" class="btn btn-sm btn-primary" value="update">
	    				 	 <a href="index.php" class="btn btn-sm btn-danger"> Home</a>
	    				 </div>
  					</div>

				</form>
			</div>
		</div>
	</div>
<?php 
	if(isset($_POST['update'])){
		$nama    	= $_POST['nama'];
		$jurusan 	= $_POST['jurusan'];
		$alamat   	= $_POST['alamat'];
		$fotoLama 	= $_POST['fotoLama']; // variable baru $fotoLama kita ambil nilainya dari nilai sebelumnya

		if ($_FILES['foto']['error'] === 4 ) {
				$foto = $fotoLama;

				$query 	= mysqli_query($conn,"UPDATE mahasiswa SET 
					nama='$nama',
					jurusan = '$jurusan',
					alamat = '$alamat',
					foto = '$foto' -- mengisi kolom gambar dengan fotoLama
					WHERE id='$id'");

				if ($query) {
					mysqli_close($conn);// kita tutup ya koneksinya :)
					echo "<script>alert('data berhasil diubah')</script>";
					header("refresh:1, url=index.php");
				}else{
					echo "error ".mysqli_error();
					die;
				}

		}else{
			$gambar = $_POST['fotoLama'];
			unlink("assets/images/$gambar");

			$namaGambar = $_FILES['foto']['name'];
			$sizeGambar = $_FILES['foto']['size'];
			$tmpGambar	= $_FILES['foto']['tmp_name'];
			$errUpload	= $_FILES['foto']['error'];

			$extGambarValid	= array('jpg','jpeg','png');
			$extGambar		= explode('.',$namaGambar);
			$extGambar		= strtolower(end($extGambar));

			$GambarNamaBaru = uniqid();
			// $GambarNamaBaru .= date('d/Y');
			$GambarNamaBaru .= '.'; 
			$GambarNamaBaru .= $extGambar;
			if (move_uploaded_file($tmpGambar,'assets/images/'.$GambarNamaBaru)) {
				

				$query 	= mysqli_query($conn,"UPDATE mahasiswa SET 
					nama='$nama',
					jurusan = '$jurusan',
					alamat = '$alamat',
					foto = '$GambarNamaBaru' -- mengisi kolom gambar dengan gambarBaru
					WHERE id='$id'");

				if ($query) {
					mysqli_close($conn);// kita tutup ya koneksinya :)
					echo "<script>alert('data berhasil diubah')</script>";
					header("refresh:1, url=index.php");
				}else{
					echo "error ".mysqli_error();
					die;
				}

			}else{
				echo "<script>alert('Gagal Diupload !');</script>";
			}
			
		}
	}
}else{
	 	header("Location: index.php");
}
?>
	<script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>