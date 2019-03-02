<?php include 'koneksi.php'; 
if (isset($_GET['id'])) {
	$id 	= $_GET['id'];
	$read 	= "SELECT*FROM mahasiswa WHERE id=$id";
	$query	= mysqli_query($conn,$read);
	$row 	= mysqli_fetch_assoc($query);
}
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
    <link href="assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
	  <h3 align="center">CRUD DENGAN MYSQLI / PROCEDURAL | MASDZIK.COM</h3>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				  <div class="panel panel-primary">
					<div class="panel-heading"><i class="fa fa-eye"></i> Details Data Mahasiswa </div>
					  <div class="panel-body"> 	
					  	<div class="form-group">
					      <label for="nama">Nama : </label>
					      <input class="form-control" id="nama" type="text" placeholder="<?= $row['nama']; ?>" disabled>
					    </div>
						<div class="form-group">
					      <label for="jurusan">Jurusan : </label>
					      <input class="form-control" id="jurusan" type="text" placeholder="<?= $row['jurusan']; ?>" disabled>
					    </div>
						<div class="form-group">
					      <label for="foto">Foto : </label><br>
					      <img src="assets/images/<?= $row['foto'];?>" class="img-thumbnail" width="150px" height="150px">
						</div>
						<div class="form-group">
					      <label for="alamat">Alamat : </label>
					      <input class="form-control" id="alamat" type="text" placeholder="<?= $row['alamat']; ?>" disabled>
					    </div>
    				 </div>
    				 <div class="panel-footer">
    				 	<a href="index.php" class="btn btn-sm btn-primary"><i class="fa fa-mail-reply"></i> Back</a>
    				 </div>
  				</div>
			</div>
		</div>
	</div>
	<?php mysqli_close($conn); ?>
	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>