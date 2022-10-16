<?php
session_start();
include("config.php");

//code to Register/add
    if(isset($_POST['addUser'])){
        $sql="INSERT INTO users (name, email, password, acct_type) VALUES (:name, :email, :pword, 'User')";
        $stmt=$conn->prepare($sql);
        $stmt->execute([':name'=>$_POST['name'],
                        ':email'=>$_POST['email'],
                        ':pword'=>$_POST['password']]);
        header("location:LoginPage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
        <title>Join WIZELY</title>
        <link rel="stylesheet" href="CSS/logreg.css">
	</head>
	<body>
        
        <div class="form">
                <form id="register" class="input" action="" method="POST">
                        <h1>Start with WIZELY</h1>
                        <input type="text" name="name" class="input-field" placeholder="Fullname" required>
                        <input type="email" name="email" class="input-field" placeholder="Email" required>
                        <input type="password" name="password" class="input-field" placeholder="Password" required>
                        <button type="submit" class="submit-btn" name="addUser">REGISTER</button>
                        <p>Already have an account?</p>
                        <h4><a href="LoginPage.php">Log in</a></h4>
                </form>
        </div>
	</body>
</html>
<script src="bootstrap/jquery.js"></script>