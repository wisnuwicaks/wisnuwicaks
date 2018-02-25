<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
 
require('db.php');
include("auth.php");
$nisn=$_REQUEST['nisn'];
$query = "SELECT * from siswa where nisn='".$nisn."'"; 
$result = pg_query($db, $query);
$row = pg_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> | <a href="insert.php">Tambah Data Baru</a> | <a href="logout.php">Logout</a></p>
<h1>Update Data</h1>
<?php
$passing_input = 0;
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$nisnbaru=$_REQUEST['nisnbaru'];
$nama =$_REQUEST['nama'];
$kelas =$_REQUEST['kelas'];
$tempat_lahir =$_REQUEST['tempat_lahir'];
$tanggal_lahir =$_REQUEST['tanggal_lahir'];
$jenis_kelamin =$_REQUEST['jenis_kelamin'];


$nama = strtoupper($nama);
$tempat_lahir = strtoupper($tempat_lahir);

$cek_nisn  = "SELECT nisn from siswa where nisn = $1";
$cek_nisn1 = pg_query_params($db,$cek_nisn,array($nisnbaru));
$cek_nisn2 = pg_fetch_assoc($cek_nisn1);
$cek_nisn3 = $cek_nisn2['nisn'];
	
	if($cek_nisn3){

		echo "<p align=\"center\">NISN telah terdaftar<br></p>";
			$passing_input = 1;

		}
$submittedby = $_SESSION['uname'];

	if($passing_input == 0){
$update="update siswa set nisn='".$nisnbaru."',nama='".$nama."', kelas='".$kelas."', tempat_lahir ='".$tempat_lahir."', tanggal_lahir='".$tanggal_lahir."', jenis_kelamin='".$jenis_kelamin."' where nisn='".$nisn."'";
pg_query($db, $update);


$status = "Updated Benar. </br></br><a href='view_siswa.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}

else {

	echo "<p align=\"center\">Update Gagal<br></p>";
	$status = "</br></br><a href='edit.php?'>Update Ulang</a>";
	$status1 = "</br></br><a href='view_siswa.php'>Kembali</a>";
	//echo '<p style="color:#FF0000;">'.$status.'</p>';
	echo '<p style="color:#FF0000;">'.$status1.'</p>';
}

//echo $update;
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="nisn" type="hidden" value="<?php echo $row['nisn'];?>" />
<p><input type="text" name="nisnbaru" placeholder="Masukkan NISN" required value="<?php echo $row['nisn'];?>" /></p>
<p><input type="text" name="nama" placeholder="Masukkan Nama" required value="<?php echo $row['nama'];?>" /></p>
<p><input type="number" min="7" max="9" name="kelas" placeholder="Kelas" required /></p>
<p><input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required value="<?php echo $row['tempat_lahir'];?>" /></p>
<p><input type="text" name="tanggal_lahir" placeholder="Tanggal Lahir" required value="<?php echo $row['tanggal_lahir'];?>" /></p>
<select name="jenis_kelamin" placeholder="Jenis Kelamin" required /></p>
<option> Jenis Kelamin</option>
<option> Laki-Laki </option>
<option> Perempuan </option>
</select>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>

<br /><br /><br /><br />
</div>
</div>
</body>
</html>
