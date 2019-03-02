<?php 
include 'koneksi.php';
	$id 	= $_GET['id'];
	$readId = mysqli_query($conn,"SELECT*FROM mahasiswa WHERE id=$id");
	$delete = mysqli_query($conn,"DELETE FROM mahasiswa WHERE id=$id");

	$row = mysqli_fetch_array($readId);
	
	$foto = $row['foto'];
	unlink("assets/images/$foto");
	
	if ($delete) { 
		echo "<script>alert('Data berhasil dihapus');</script>";
		header("refresh:1, url=index.php");
	}else{
		echo "Terjadi kesalahan ".mysqli_error();
	}
?>