<?php
require('db.php');
include("auth.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Data Wali Siswa</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="center" class="form">
<p><a href="dashboard.php">Dashboard</a> | <a href="insert.php">Tambah Data Baru</a> | <a href="logout.php">Logout</a></p>

$<?php

$sort_nik = 0;
$sort_nama = 0;
$sort_tempat = 0;
$sort_tanggal = 0;

if(isset($_GET['sort_nik'])){

$sort_nik = $_GET['sort_nik'];

}

if(isset($_GET['sort_nama'])){

$sort_nama = $_GET['sort_nama'];

}


if(isset($_GET['sort_tempat'])){

$sort_tempat = $_GET['sort_tempat'];

}

if(isset($_GET['sort_tanggal'])){

$sort_tanggal = $_GET['sort_tanggal'];

}
?>

<h2 align="center">Data Wali Siswa</h2>
<form align="center" action="view_orangtua.php" method="post">
            <input type="text" name="cari" placeholder="Search">
            <input type="submit" name="Search" value="Search" />
            	<form  action="view_orangtua.php" method="post">
            			<input type="submit" value="Reset" /> 
        		</form>
    </form><br></br>
<table align="center" width="50%" border="1" style="border-collapse:collapse;" cellpadding="3">
<thead>
		<tr><th><strong>No</strong></th>
		<th><strong><a href="?sort_nik=<?php if ($sort_nik == 2){echo '1';} else echo '2';?>"> NIK </a></strong></th>
		<th><strong><a href="?sort_nama=<?php if ($sort_nama == 2){echo '1';} else echo '2';?>"> Nama Wali </a></strong></th>
		<th><strong><a href="?sort_tempat=<?php if ($sort_tempat == 2){echo '1';} else echo '2';?>"> Tempat Lahir </a></strong></th>
		<th><strong><a href="?sort_tanggal=<?php if ($sort_tanggal == 2){echo '1';} else echo '2';?>"> Tanggal Lahir </a></strong></th>
		<th><strong>Jenis Kelamin</strong></th>
		<th><strong>Agama</strong></th>
		<th><strong>Pekerjaan</strong></th>
		<!-- <th><strong>Edit</strong></th> -->
		<th><strong>Delete</strong></th></tr>
		</thead>

<tbody>

<?php
$pass = 20;
$count=1;
if(isset($_POST['Search'])){
        $cari   = strtoupper($_POST['cari']);
        $sel_query = "SELECT * from orang_tua where nama_wali like '%$cari%'";
    }
else {
    	$sel_query="SELECT * from orang_tua";
    }

if($sort_nik==2){ 
        $sel_query = $sel_query . " order by nik asc"; 
    //	$sort_nisn = 0;
    } 

   else if($sort_nik == 1) {
   		$sel_query = $sel_query . " order by nik desc"; 
   	//	$sort_nisn = 0;
}

	else {

		$sel_query;
	}




if($sort_nama==2){ 
        $sel_query = $sel_query . " order by nama_wali asc"; 
    } 

   else if ($sort_nama == 1)  {
   		$sel_query = $sel_query . " order by nama_wali desc"; 
}

	else {

		$sel_query;
	}

if($sort_tempat==2){ 
        $sel_query = $sel_query . " order by tempat_lahir asc"; 
    } 

   else if ($sort_tempat == 1){
   		$sel_query = $sel_query . " order by tempat_lahir desc";
}

	else {

		$sel_query;
	}

if($sort_tanggal==2){ 
        $sel_query = $sel_query . " order by tanggal_lahir asc"; 
    } 

   else if ($sort_tanggal == 1) {
   		$sel_query = $sel_query . " order by tanggal_lahir desc";
}

	else {
		$sel_query;
	}
//$sel_query="SELECT * from orang_tua";
$result = pg_query($db,$sel_query);
while($row = pg_fetch_assoc($result)) { 


//?>

	<tr> 
		<td nowrap align="center">
		<?php echo $count; ?>
		</td>

		<td nowrap align="center">
		<?php echo $row["nik"]; ?>
		</td>

		<td nowrap align="left">
		<?php echo $row["nama_wali"];?>
		</td>

		<td nowrap align="center">
		<?php echo $row["tempat_lahir"];?>
		</td>

		<td nowrap align="center">
		<?php echo $row["tanggal_lahir"];?>
		</td>

		<td nowrap align="center">
		<?php echo $row["jenis_kelamin"];?>
		</td>

		<td nowrap align="center">
		<?php echo $row["agama"];?>
		</td>

		<td nowrap align="left">
		<?php echo $row["pekerjaan"];?>
		</td>

		<!-- <td align="center"><a href="edit.php?nik=<?php echo $row["nik"]; ?>">Edit</a></td>-->
			<td  
		align="center"><a href="delete.php?nik=<?php echo $row["nik"]; ?>&amp;pass=<?php echo $pass; ?>"	>Delete</a></td>
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
