<?php
    session_start();
    include("config.php");
   //session
   if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sql="SELECT * FROM users WHERE email=:em AND password=:pw";
    $stmt=$conn->prepare($sql);
    $stmt->execute([':em'=>$_POST['e-mail'],
                    ':pw'=>$_POST['pword']]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$stmt->rowCount();

    if($count==1){
        $_SESSION['user']=$_POST['e-mail'];
        $login_access=$row['acct_type'];
        if($login_access=="Admin")
        header("location: admin.php");
        elseif($login_access=="User")
        header("location: index.php");
    }
    else{
        $error="Invalid e-mail and/or password";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
        <title>Login</title>
        <link rel="stylesheet" href="CSS/logreg.css">
	</head>
	<body>
        
        <div class="form">
                <form id="login" class="input" action="" method="POST">
                        <h1>WIZELY</h1>
                        <input type="email" class="input-field" name="e-mail" placeholder="Email" required>
                        <input type="password" class="input-field" name="pword" placeholder="Password" required>
                        <button type="submit" class="submit-btn">LOG IN</button>
                        <?php if(isset($error)){?>
                            <div class="alert alert-danger" role="alert" style="color:red;text-align:center">
                                <?php echo $error;?>
                            </div>
                            <?php }?>
                        <p>Start Web Designing?</p>
                        <h4><a href="Register.php">Join now!</a></h4>
                </form>
        </div>
	</body>
</html>
