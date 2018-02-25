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
	<style>
.button {
    background-color: white;
    border: none;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<meta charset="utf-8">
		<title>Tabel Data Siswa</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
<body>
<div class="center" class="form">
	<p>
		<a href="dashboard.php">Dashboard</a> | 
		<a href="insert.php">Tambah Data Baru</a> | 
		<a href="logout.php">Logout</a>
	</p>
<?php
$sort_nisn = 0;
$sort_nama = 0;
$sort_kelas = 0;
$sort_tempat = 0;
$sort_tanggal = 0;

if(isset($_GET['sort_nisn'])){

$sort_nisn = $_GET['sort_nisn'];

}

if(isset($_GET['sort_nama'])){

$sort_nama = $_GET['sort_nama'];

}

if(isset($_GET['sort_kelas'])){

$sort_kelas = $_GET['sort_kelas'];

}

if(isset($_GET['sort_tempat'])){

$sort_tempat = $_GET['sort_tempat'];

}

if(isset($_GET['sort_tanggal'])){

$sort_tanggal = $_GET['sort_tanggal'];

}


//echo "test";
//echo $sort;
//echo '2';

?>
<h2 align="center">Tabel Data Siswa </h2>
 <form align="center" action="view_siswa.php" method="post">
            <input type="text" name="cari" placeholder="Search">
            <input type="submit" name="Search" value="Search" />
            	<form  action="view_siswa.php" method="post">
            			<input type="submit" value="Reset" /> 
        		</form>
    </form><br></br>
<table width="50%" border="1" align="center" cellpadding="3">
	


}<thead>
		<form action="view_siswa.php" method="post" >
		<tr><th><strong>No</strong></th>
		<th><strong><a href="?sort_nisn=<?php if ($sort_nisn == 2){echo '1';} else echo '2';?>"> NISN </a></strong></th>
		<th><strong><a href="?sort_nama=<?php if ($sort_nama == 2){echo '1';} else echo '2';?>"> Nama </a></strong></th>
		<th><strong><a href="?sort_kelas=<?php if ($sort_kelas == 2){echo '1';} else echo '2';?>"> Kelas </a></strong></th>
		<th><strong><a href="?sort_tempat=<?php if ($sort_tempat == 2){echo '1';} else echo '2';?>"> Tempat Lahir </a></strong></th>
		<th><strong><a href="?sort_tanggal=<?php if ($sort_tanggal == 2){echo '1';} else echo '2';?>"> Tanggal Lahir </a></strong></th>
		<th><strong>Jenis Kelamin</strong></th>
		<th><strong>Alamat</strong></th>
		<th><strong>Edit</strong></th>
		<th><strong>Delete</strong></th></tr>
		</form>
		</thead>

<tbody>


<?php
$pass = 10;
$count=1;



if(isset($_POST['Search'])){
        $cari   = strtoupper($_POST['cari']);
        $sel_query = "SELECT * from siswa where nama like '%$cari%'";
    }
    else {
    	$sel_query="SELECT * from siswa";
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
if($sort_kelas==2){ 
        $sel_query = $sel_query . " order by kelas asc"; 
    } 

   else if ($sort_kelas == 1){
   		$sel_query = $sel_query . " order by kelas desc"; 
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
		<?php echo $row["kelas"];?>
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

		<td nowrap align="left">
		<?php echo $row["alamat"];?>
		</td>

		<td align="center"><a href="edit.php?nisn=<?php echo $row["nisn"]; ?>">Edit</a></td><td 
			align="center"><a href="delete.php?nisn=<?php echo $row["nisn"]; ?>&amp;pass=<?php echo $pass; ?>"	>Delete</a></td>
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
