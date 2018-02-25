<?php

include('db.php');
$pass = $_REQUEST['pass'];
$nisn    = $_REQUEST['nisn'];
$nik = $_REQUEST['nik'];



if($pass == 10){
	function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

	$cek_nik = "SELECT orang_tua.nik as nomor from siswa_orangtua,orang_tua where siswa_orangtua.nisn = $1 and orang_tua.nik= siswa_orangtua.nik";

	if(!$cek_nik){

		echo "gagal";
	}
	$cek_nik1 = pg_query_params($db,$cek_nik,array($nisn));
	
	if(!$cek_nik1){

		echo "gagal1";
	}

	$cek_nik2 = pg_fetch_assoc($cek_nik1);
	
	//echo $cek_nik2;

	$cek_nik3 = $cek_nik2['nomor'];


	if(!$cek_nik2){

		echo "gagal2";
	}
	

//	echo $cek_nik3;
	$delete_nik    = "DELETE FROM orang_tua WHERE nik = $1";
	$delete_nik1   = pg_query_params($db,$delete_nik,array($cek_nik3));
	
	

//	echo $nisn;

	$delete_siswa  = "DELETE FROM siswa WHERE nisn = $1";
	$delete_siswa1 = pg_query_params($db,$delete_siswa,array($nisn));

	if(!$delete_siswa1){

		echo "gagalsiswa";
	}

		goback();
		//header('Location: view_siswa.php');

}

if($pass == 20){

	$cek_nisn = "SELECT siswa.nisn as nomor2 from
		siswa_orangtua,siswa where siswa_orangtua.nik = $1 and
		siswa.nisn= siswa_orangtua.nisn";

	if(!$cek_nisn){

		echo "gagal";
	}
	$cek_nisn1 = pg_query_params($db,$cek_nisn,array($nik));
	
	if(!$cek_nisn1){

		echo "gagal1";
	}

	$cek_nisn2 = pg_fetch_assoc($cek_nisn1);
	
	//echo $cek_nik2;

	$cek_nisn3 = $cek_nisn2['nomor2'];


	if(!$cek_nisn2){

		echo "gagal2";
	}

	$delete_ortu  = "DELETE FROM orang_tua WHERE nik = $1";
	$delete_ortu1 = pg_query_params($db,$delete_ortu,array($nik));

	$delete_siswa23 = "DELETE FROM siswa where nisn = $1";
	$delete_siswa3 = pg_query_params($db,$delete_siswa23,array($cek_nisn3));
	

	header('Location: view_orangtua.php');

}


//delete semua
//balik ke

?>