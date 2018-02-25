 <?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
 
require('db.php');
include("auth.php");

$status = "";
if (isset($_POST['submit'])){

		$nisn = $_POST['nisn'];
		$nama = $_POST['nama'];
		$gender = $_POST['jenis_kelamin'];
		$kelas = $_POST['kelas'];
		$tempat = $_POST['tempatsiswa'];
		$tanggal = $_POST['tanggalsiswa'];
		$alamat = $_POST['alamat'];
		$nik = $_POST['nik'];
		$namaortu = $_POST['nama1'];
		$genderortu = $_POST['gender'];
		$tempat1 = $_POST['tempatortu'];
		$tanggal1 = $_POST['tanggalortu'];
		$agama = $_POST['agama'];
		$job = $_POST['pekerjaan'];
		$kel = $_POST['kelurahan'];
		$kec = $_POST['kecamatan'];
		$passing_input = 0;
		//Upper case
		$nama = strtoupper($nama);
		$tempat = strtoupper($tempat);
		$alamat = strtoupper($alamat);
		$namaortu = strtoupper($namaortu);
		$tempat1 = strtoupper($tempat1);
		$agama = ucfirst($agama);
		$job = ucwords($job);
		$kel = strtoupper($kel);

		//kode kelurahan
		$cek_kode  = "SELECT kode from kode_kelurahan where kelurahan = $1";
		$cek_kode1 = pg_query_params($db,$cek_kode,array($kel));
		$kode_kel  = pg_fetch_assoc($cek_kode1);
		$kelurahan_kode = $kode_kel['kode'];

		if(!$kode_kel){

			echo "Kelurahan atau Kecamatan tidak terdaftar";
			$passing_input = 1;
		}

		if($genderortu == 'Jenis Kelamin' || $gender == 'Jenis Kelamin'){

			echo "Jenis Kelamin belum dipilih";
			$passing_input = 1;
		}

		//cek nisn dan nik
		$cek_nisn  = "SELECT nisn from siswa where nisn = $1";
		$cek_nisn1 = pg_query_params($db,$cek_nisn,array($nisn));
		$cek_nisn2 = pg_fetch_assoc($cek_nisn1);
		$cek_nisn3 = $cek_nisn2['nisn'];
	
		if($cek_nisn3){

			echo "<p align=\"center\">NISN telah terdaftar<br></p>";
			$passing_input = 1;
		}

		$cek_nik  = "SELECT nik from orang_tua where nik = $1";
		$cek_nik1 = pg_query_params($db,$cek_nik,array($nik));
		$cek_nik2 = pg_fetch_assoc($cek_nik1);
		$cek_nik3 = $cek_nik2['nik'];
	
		if($cek_nik3){

			echo "<p align=\"center\">NIK telah terdaftar<br></p>";
			$passing_input = 1;
		}


	if($passing_input == 0){
		$insert1 = "INSERT INTO siswa (nisn, kelas, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat) VALUES ($1, $2, $3, $4, $5, $6, $7)";

		$insert2 = "INSERT INTO orang_tua (nik, nama_wali, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, pekerjaan) VALUES ($1, $2, $3, $4, $5, $6, $7)";

		$insert3 = "INSERT INTO siswa_daerah (nisn, kode_kelurahan) VALUES ($1,$2)";
		$insert4 = "INSERT INTO siswa_orangtua (nisn, nik) VALUES ($1,$2)";
		$insert_siswa = pg_query_params($db,$insert1,array($nisn,$kelas,$nama,$tempat,$tanggal,$gender,$alamat));
		$insert_orangtua = pg_query_params($db,$insert2,array($nik,$namaortu,$tempat1,$tanggal1,$genderortu,$agama,$job));
		$insert_alamat = pg_query_params($db,$insert3,array($nisn, $kelurahan_kode));
		$insert_siswa_orangtua = pg_query_params($db,$insert4,array($nisn, $nik));

		$status = "Data Baru Berhasil Ditambah.</br></br><a href='view_siswa.php'>Lihat data Terbaru</a>";

	}

	else {

		echo "<p align=\"center\">Input Gagal<br></p>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> | <a href="view_siswa.php">Lihat Data</a> | <a href="logout.php">Logout</a></p>

<div>
<h1>Insert New Data</h1>
<form action="insert.php" method="post"> 
<h2>Data Siswa</h2>
<input type="hidden" name="new" value="1" />
<p><input type="text" maxlength="10" minlength="10" name="nisn" placeholder="NISN Siswa" required /></p>
<p><input type="number" min="7" max="9" name="kelas" placeholder="Kelas" required /></p>
<p><input type="text" name="nama" placeholder="Nama Siswa" requiered /></p>
<p><input type="text" name="tempatsiswa" placeholder="Tempat Lahir" required /></p>
<p><input type="text" name="tanggalsiswa" placeholder="Tanggal Lahir (dd/mm/yyyy)" required /></p>

<select name="jenis_kelamin" placeholder="Jenis Kelamin" required /></p>
<option> Jenis Kelamin</option>
<option> Laki-Laki </option>
<option> Perempuan </option>
</select>
<p><input type="text" name="alamat" placeholder="Alamat" required />
<input type="text" name="kelurahan" placeholder="Kelurahan" required />
<input type="text" name="kecamatan" placeholder="Kecamatan" required /></p>

<h3>Data Orang Tua</h3>
<p><input type="text" maxlength="16" minlength="16" name="nik" placeholder="NIK Orang Tua" required /></p>
<p><input type="text" name="nama1" placeholder="Nama Orang Tua" requiered /></p>

<select name="gender" placeholder="Jenis Kelamin" required /></p>
<option> Jenis Kelamin</option>
<option> Laki-Laki </option>
<option> Perempuan </option>
</select>
<p><input type="text" name="tempatortu" placeholder="Tempat Lahir" required /></p>
<p><input type="text" name="tanggalortu" placeholder="Tanggal Lahir (dd/mm/yyyy)" required/></p>
<p><input type="text" name="agama" placeholder="Agama" required /></p>
<p><input type="text" name="pekerjaan" placeholder="Pekerjaan" required /></p>
<p><input type="submit" name="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>

<br /><br /><br /><br />

</div>
</div>
</body>
</html>
