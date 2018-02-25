    <?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.

    if (isset($_POST['login'])){      
        $username = $_POST['username'];
        $hashed = pg_query($db,"SELECT password FROM login WHERE username = '{$username}'");
        $sama = pg_fetch_row($hashed);
        $pass = $_POST['password'];
        $row = pg_num_rows($hashed);
        if($row > 0){
            if(password_verify($pass, $sama[0])){
                session_start();
                $_SESSION['uname'] = $username;
                header("location:index.php");
            }
            else { echo 'Login gagal!'; }
        }
        else {
            echo 'Username tidak ditemukan!';
        }
    }


    if (isset($_POST['register'])){	
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hash = password_hash("$password", PASSWORD_DEFAULT);
		$result = pg_query_params($db, 'INSERT INTO login (username,password) values ($1,$2)', array($username, $hash));
        if($result){
            echo 'Data berhasil disimpan!';
        }
        else{
            echo 'Data tidak berhasil disimpan!';
        }
    }
?>
<div class="form">
<h1>User Login</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="register" value="Register" />
<input type="submit" name="login" value="Login" />
</form>
<br /><br />
</div>
<?php ?>
</body>
</html>
