<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
 
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta  charset="utf-8">
<title>Data Alamat</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="center" class="form" >
<p><a href="index.php">Dashboard</a> | <a href="insert.php">Tambah Data Baru</a> | <a href="logout.php">Logout</a></p>

<?php
$sort_nisn = 0;
$sort_nama = 0;
$sort_kel = 0;
$sort_kec = 0;

if(isset($_GET['sort_nisn'])){

$sort_nisn = $_GET['sort_nisn'];

}

if(isset($_GET['sort_nama'])){

$sort_nama = $_GET['sort_nama'];

}

if(isset($_GET['sort_kel'])){

$sort_kel = $_GET['sort_kel'];

}

if(isset($_GET['sort_kec'])){

$sort_kec = $_GET['sort_kec'];

}
?>
<h2 align="center" >Data Alamat</h2>
<form align="center" action="view_alamatlengkap.php" method="post">
            <input type="text" name="cari" placeholder="Nama">
            <input type="submit" name="Search" value="Search" />
            	<form  action="view_alamatlengkap.php" method="post">
            			<input type="submit" value="Reset" /> 
        		</form>

<table align="center" width="50%" border="1" style="border-collapse:collapse;" cellpadding="3">
<thead>
		<tr><th><strong>No</strong></th>
		<th><strong><a href="?sort_nisn=<?php if ($sort_nisn == 2){echo '1';} else echo '2';?>"> NISN </a></strong></th>
		<th><strong><a href="?sort_nama=<?php if ($sort_nama == 2){echo '1';} else echo '2';?>"> Nama </a></strong></th>
		<th><strong>Alamat</strong></th>
		<th><strong><a href="?sort_kel=<?php if ($sort_kel == 2){echo '1';} else echo '2';?>"> Kelurahan </a></strong></th>
		<th><strong><a href="?sort_kec=<?php if ($sort_kec == 2){echo '1';} else echo '2';?>"> Kecamatan </a></strong></th>
<!-- 		<th><strong>Edit</strong></th>
		<th><strong>Delete</strong></th></tr> -->
		</thead>

<tbody>

<?php
$oass = 10;
$count=1;

if(isset($_POST['Search'])){
        $cari   = strtoupper($_POST['cari']);
        $sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn where s.nama like '%$cari%';";
    }
    else {
    	$sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn;";

    }


if($sort_nisn==2){ 
        $sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by s.nisn asc;"; 
    //	$sort_nisn = 0;
    } 

   else if($sort_nisn == 1) {
   		$sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by s.nisn desc;";
   	//	$sort_nisn = 0;
}

	else {

		$sel_query;
	}




if($sort_nama==2){ 
        $sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by s.nama asc;"; 
    } 

   else if ($sort_nama == 1)  {
   		$sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by s.nama desc;";
}

	else {

		$sel_query;
	}
if($sort_kel==2){ 
        $sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by kelurahan asc;";
    } 

   else if ($sort_kel == 1){
   		$sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by kelurahan desc;";
}

	else {

		$sel_query;
	}
if($sort_kec==2){ 
        $sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by kecamatan asc;";
    } 

   else if ($sort_kec == 1){
   		$sel_query="with data as (select * from siswa_daerah sd inner join kode_kelurahan k on sd.kode_kelurahan=k.kode)
			select nama,s.nisn,alamat,kelurahan,kecamatan from siswa s inner join data on s.nisn=data.nisn order by kecamatan desc;";
}

	else {

		$sel_query;
	}

$result = pg_query($db,$sel_query);
while($row = pg_fetch_assoc($result)) { 


//?>

	<tr> 
		<td nowrap align="center">
		<?php echo $count; ?>
		</td>

		<td nowrap align="center">
		<?php echo $row["nisn"]; ?>
		</td>

		<td nowrap align="left">
		<?php echo $row["nama"];?>
		</td>

		<td nowrap align="left">
		<?php echo $row["alamat"];?>
		</td>

		<td nowrap align="center">
		<?php echo $row["kelurahan"];?>
		</td>

		<td nowrap align="center">
		<?php echo $row["kecamatan"];?>
		</td>

		<!-- <td align="center"><a href="edit.php?nisn=<?php echo $row["nisn"]; ?>">Edit</a></td><td 
		align="center"><a href="delete.php?nisn=<?php echo $row["nisn"]; ?>&amp;pass=<?php echo $pass; ?>"	>Delete</a></td> -->
	</tr>

<?php $count++; 
} ?>
</tbody>
</table>

<br /><br /><br /><br />
<!-- <a href="https://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/">Tutorial Link</a> <br /><br />
For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/">AllPHPTricks.com</a>
 --></div>
</body>
</html>

