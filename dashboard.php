<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
 
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Secured Page</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Welcome to Dashboard.</p>

<p><a href="index.php">Home</a><p>
<p><a href="insert.php">Insert New Data</a></p>
<p><a href="view_siswa.php">Data Siswa</a><p>
<p><a href="view_orangtua.php">Data Wali</a><p>
<p><a href="view_no_rekomendasi.php">Data Nomor Rekomendasi</a><p>
<p><a href="view_alamatlengkap.php">Data Alamat Lengkap</a><p>
<p><a href="logout.php">Logout</a></p>
<br /><br /><br /><br />
</div>
</body>
</html>
