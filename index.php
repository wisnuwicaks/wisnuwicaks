<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/

include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<p>Welcome 
	<?php
	require 'db.php';
	 
	echo $_SESSION['uname']; 

	if($_SESSION['uname'] == NULL){
	header("location:registration.php");
	}

?>!</p>
<p>This is secure area.</p>
<p><a href="dashboard.php">Dashboard</a></p>
<a href="logout.php">Logout</a>


<br /><br /><br /><br />
</div>
</body>
</html>
