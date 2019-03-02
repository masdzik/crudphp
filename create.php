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
    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
	  	<h5 align="center">CRUD DENGAN MYSQLI / PROCEDURAL | MASDZIK.COM</h5>
	  	<div class="row">
		  <div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
		  		<div class="panel-heading"><i class="fa fa-user"></i> Tambah Data Mahasiswa</div>
					<div class="panel-body">
						<form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>">
						<div class="form-group">
							<label for="nama">Nama : </label>
							<input type="text" name="nama" class="form-control" placeholder="nama anda" required="nama">
						</div>
						<div class="form-group">
							<label for="jurusan">Jurusan : </label>
							<select name="jurusan" class="form-control">
								<option value="Teknik Kimia">Teknik Kimia</option>
								<option value="Teknik Mesin">Teknik Mesin</option>
								<option value="Teknik Informatika">Teknik Informatika</option>
								<option value="Teknik Sipil">Teknik Sipil</option>
								<option value="Teknik Elektro">Teknik Elektro</option>
							</select>
						</div>
						<div class="form-group">
							<label for="foto">Foto Profil : </label>
							<input type="file" name="foto">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat : </label>
							<input type="text" name="alamat" class="form-control" placeholder="alamat anda" required="jurusan">
						</div>
							<input type="submit" name="submit" class="btn btn-md btn-success">
							<button type="reset" class="btn btn-md btn-warning"> Reset</button>
							<a href="index.php" class="btn btn-md btn-danger"> Home</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
	if (isset($_POST['submit'])) {
		
		$nama     = htmlspecialchars($_POST['nama']); // mengambil inputan dari form input name="nama"
		$jurusan  = htmlspecialchars($_POST['jurusan']);// mengambil isi dari form select="jurusan"
		$alamat   = htmlspecialchars($_POST['alamat']);// mengambil inputan dari form alamat input name="alamat"
		
		$namaGambar = $_FILES['foto']['name']; // mengambil nama gambar
		$sizeGambar = $_FILES['foto']['size']; // mengambil size gambar
		$tmpGambar	= $_FILES['foto']['tmp_name']; // mengambil asal folder gambar
		$errUpload	= $_FILES['foto']['error']; // pengecekan apakah error / tidak

		if ($errUpload === 4) {
			echo "<script>alert('Pilih gambar dahulu !');</script>";
			return false;
		}

		$extGambarValid	= array('jpg','jpeg','png');
		$extGambar = explode('.',$namaGambar);
		$extGambar = strtolower(end($extGambar));

		if (!in_array($extGambar,$extGambarValid)) {
			echo "<script>alert('File wajib gambar !');</script>";
			return false;
		}
		$GambarNamaBaru = uniqid();
		// $GambarNamaBaru .= date('d/Y');
		$GambarNamaBaru .= '.'; 
		$GambarNamaBaru .= $extGambar;
		if (move_uploaded_file($tmpGambar,'assets/images/'.$GambarNamaBaru)) {
			$insert  = "INSERT INTO mahasiswa VALUES 
			(
			'',-- id nya karena auto increment jadi kita kosongkan --
			'$nama', -- mengisi kolom nama dengan nama yg diinput user
			'$jurusan',-- mengisi kolom jurusan dengan nama yg diinput user
			'$GambarNamaBaru',-- mengisi kolom gambar dengan nama uniq
			'$alamat'-- mengisi kolom alamat dengan nama yg diinput user
			)";
			$query = mysqli_query($conn,$insert);
			if ($query) {
				mysqli_close($conn); // kita tutup ya koneksinya :)
				echo "<script>alert('data berhasil ditambah')</script>";
				header("refresh:1, url=index.php"); // redirect ke index.php dengan jeda waktu 1 detik
			}else{
				echo "Error pada ".mysqli_error();
				die;
			}
		}else{
			echo "<script>alert('Gagal Diupload !');</script>";
		}
}else{

}

?>
	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>