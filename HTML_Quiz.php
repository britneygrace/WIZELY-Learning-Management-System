<?php
session_start();
include("config.php");

if (isset($_SESSION['user'])) {
	$user_check = $_SESSION['user'];
	$sql = "SELECT * FROM users WHERE email='$user_check'";
	$stmt = $conn->query($sql);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$login_user = $row['name'];
	$user_id = $row['ID'];
	$acct_type = $row['acct_type'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>WIZELY | HTML QUIZ</title>
	<link rel="stylesheet" href="CSS/quizzes.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
	<!--link for the icons on footer-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background: #35424a;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<h1 style="font-weight:bolder; font-size:30px; color:white">
				<span style="color:#e8491d; font-weight:bolder; font-size:43px">WIZELY</span>
				Web Design |
			</h1>
			<ul class="navbar-nav" style="font-size: 20px;">
				<li class="nav-item">
					<a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						COURSES
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="HTML1.php">ALL ABOUT HTML</a>
						<a class="dropdown-item" href="CSS1.php">ALL ABOUT CSS</a>
					</div>
				</li>
				<li class="nav-item">
					<?php if (empty($user_check)) { ?>
						<a class="nav-link" href="LoginPage.php">TASKS</a>
					<?php } ?>
					<?php if (!empty($user_check)) { ?>
						<a class="nav-link" href="Tasks.php">TASKS</a>
					<?php } ?>
				</li>
				<li class="nav-item active dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						QUIZZES
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="HTML_Quiz.php">HTML QUIZ</a>
						<a class="dropdown-item" href="CSS_Quiz.php">CSS QUIZ</a>
					</div>
				</li>
			</ul>
		</div>
		<nav>
			<!--USER AND LOGOUT-->
			<div class="btn-group">
				<?php if (empty($user_check)) { ?>
					<a href="LoginPage.php" class="login">Login<i class="fa fa-sign-in" aria-hidden="true"></i></a>
				<?php } ?>
				<?php if (!empty($user_check)) { ?>
					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php if (empty($row['profile_pic'])) { ?>
							<span class="navbar-text text-white" style="font-size: 20px; padding:0">
								<?php echo $login_user ?>
							<?php } else { ?>
								<?php echo '<img id="profile" src="upload/' . $row['profile_pic'] . '"' ?>
							</span>
						<?php } ?>
					</button>
				<?php } ?>
				<div class="dropdown-menu w-100">
					<a class="dropdown-item" href="editprofile.php" style="color: green; font-size:20px">My Profile</a>
					<hr>
					<a class="dropdown-item" href="logout.php" style="color: red; font-size:20px">Logout</a>
				</div>
			</div>
		</nav>
	</nav>
	<form action="" method="POST">

		<?php

		//FOR SCORE RESULTS
		$res = 0;
		//category sana here
		if (isset($_POST['submitanswer'])) {

			if (!empty($_POST['num'])) {
				$match = count($_POST['num']);
				$select = $_POST['num'];
				$sql = "SELECT * FROM quizzes WHERE category='HTML Quiz'";
				$stmt = $conn->query($sql);
				$items = $stmt->rowCount();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$i = $row['qid'];
					$check = $row['answer'] == $select[$i];
					if ($check) {
						$res++;
					}
				}
			}
			$query = "SELECT * FROM quizrecords WHERE Name='$login_user' AND Category='HTML Quiz'";
			$result = $conn->query($query);
			// while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			if ($result->rowcount() > 0) {
				echo '<h4 style="text-align:right; margin-right:80px">YOU ALREADY TOOK THE QUIZ</h4>';
			} else {
				$sql1 = "INSERT INTO quizrecords (userId, Category, Name, Score) VALUES ('$user_id', 'HTML Quiz', '$login_user', '$res')";
				$stmt = $conn->prepare($sql1);
				$stmt->execute([]);
				echo '<h4 style="text-align:right; margin-right:80px">RECORDED</h4>';
				echo '<h4 style="text-align:right; margin-right:80px">TOTAL SCORE: ' . $res . "/" . $items . '</h4>';
			}
		}
		?>

		<?php
		$sql = "SELECT * FROM quizzes WHERE category='HTML Quiz'";
		$stmt = $conn->query($sql);
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		?>
			<div class="form-group">
				<li><?php echo $row['question']; ?></li>
				<input type="radio" value="<?php echo $row['option1']; ?>" name="num[<?php echo $row['qid']; ?>]" checked><?php echo $row['option1']; ?><br>
				<input type="radio" value="<?php echo $row['option2']; ?>" name="num[<?php echo $row['qid']; ?>]"><?php echo $row['option2']; ?><br>
				<input type="radio" value="<?php echo $row['option3']; ?>" name="num[<?php echo $row['qid']; ?>]"><?php echo $row['option3']; ?><br>
				<input type="radio" value="<?php echo $row['option4']; ?>" name="num[<?php echo $row['qid']; ?>]"><?php echo $row['option4']; ?><br>
				<input type="hidden" value="<?php echo $row['answer']; ?>" name="answer">
			</div>
		<?php } ?>
		<?php if (!empty($user_check)&& $acct_type!='Admin') { ?>
			<form class="form-inline my-2 my-lg-0">
				<button type="submit" class="btn btn-info w-25" name="submitanswer" style="font-size: 20px; margin-left:10%">Submit</button>
			</form>
		<?php } ?>
		<?php if (empty($user_check)) { ?>
			<form class="form-inline my-2 my-lg-0">
				<a type="button" class="btn btn-info w-25" href="LoginPage.php" style="font-size: 20px; margin-left:10%">SUBMIT</a>
			</form>
		<?php } ?>
	</form>

	<footer>
		<section>
			<p>Help</p>
			<ul>
				<li><a href="">Support</a></li>
				<li><a href="">FAQs</a></li>
			</ul>
		</section>
		<section>
			<p>Company</p>
			<ul>
				<li><a href="">About Us</a></li>
				<li><a href="">Contact Us</a></li>
			</ul>
		</section>
		<section>
			<p>Legal</p>
			<ul>
				<li><a href="">Terms & Conditions</a></li>
				<li><a href="">Privacy & Policy</a></li>
				<li><a href="">Cookies</a></li>
			</ul>
		</section>
		<section>
			<p>Follow Us</p>
			<a href="#" class="fa fa-facebook" title="Facebook"></a>
			<a href="#" class="fa fa-twitter" title="Twitter"></a>
			<a href="#" class="fa fa-linkedin" title="LinkedIn"></a>
		</section>

		<div>
			<p><span>WIZELY</span> Web Design &copy; 2021</p>
		</div>
	</footer>
	</section>

</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>