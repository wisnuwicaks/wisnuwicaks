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
<meta charset="utf-8">
<title>Data Nomor Rekomendasi</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="center" class="form" >
<p><a href="index.php">Dashboard</a> | <a href="insert.php">Tambah Data Baru</a> | <a href="logout.php">Logout</a></p>

<?php

$sort_nisn = 0;
$sort_nama = 0;

if(isset($_GET['sort_nisn'])){

$sort_nisn = $_GET['sort_nisn'];

}

if(isset($_GET['sort_nama'])){

$sort_nama = $_GET['sort_nama'];

}
?>

<h2 align="center">Data Nomor Rekomendasi</h2>
<form align="center" action="view_no_rekomendasi.php" method="post">
            <input type="text" name="cari" placeholder="Search">
            <input type="submit" name="Search" value="Search" />
            	<form  action="view_no_rekomendasi.php" method="post">
            			<input type="submit" value="Reset" /> 
        		</form>
<table align="center" width="50%" border="1" style="border-collapse:collapse;" cellpadding="3">
<thead>
		<tr><th><strong>No</strong></th>
		<th><strong><a href="?sort_nisn=<?php if ($sort_nisn == 2){echo '1';} else echo '2';?>"> NISN </a></strong></th>
		<th><strong><a href="?sort_nama=<?php if ($sort_nama == 2){echo '1';} else echo '2';?>"> Nama </a></strong></th>
		<th><strong>Nomor Rekomendasi</strong></th>
		<!-- <th><strong>Edit</strong></th>
		<th><strong>Delete</strong></th></tr>
		 --></thead>

<tbody>

<?php
$pass = 10;
$count=1;

if(isset($_POST['Search'])){
        $cari   = strtoupper($_POST['cari']);
        $sel_query="SELECT nisn,nama,no_rekomendasi from siswa s inner join no_rekomendasi n on s.kelas=n.kelas  where nama like '%$cari%';";
    }
    else {
    	$sel_query="SELECT nisn,nama,no_rekomendasi from siswa s inner join no_rekomendasi n on s.kelas=n.kelas ";

    }
 

if($sort_nisn==2){ 
        $sel_query = $sel_query . " order by nisn asc"; 
    //	$sort_nisn = 0;
    } 

   else if($sort_nisn == 1) {
   		$sel_query = $sel_query . " order by nisn desc"; 
   	//	$sort_nisn = 0;
}

	else {

		$sel_query;
	}




if($sort_nama==2){ 
        $sel_query = $sel_query . " order by nama asc"; 
    } 

   else if ($sort_nama == 1)  {
   		$sel_query = $sel_query . " order by nama desc"; 
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

		<td nowrap align="center">
		<?php echo $row["no_rekomendasi"];?>
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
For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/">AllPHPTricks.com</a> -->
</div>
</body>
</html>
