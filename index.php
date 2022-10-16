<?php
session_start();
include("config.php");

if (isset($_SESSION['user'])) {
$user_check = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE email='$user_check'";
$stmt = $conn->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$login_user = $row['name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>HOME | WIZELY Web Design</title>
	<link rel="stylesheet" href="CSS/indeex.css">
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
				<li class="nav-item active">
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
					<?php }?>
					<?php if (!empty($user_check)) { ?>
					<a class="nav-link" href="Tasks.php">TASKS</a>
					<?php }?>
				</li>
				<li class="nav-item dropdown">
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

	<main>
		<!--Main content of the document-->
		<!--Intro Content-->
		<div class="intro">
			<h1>Your First Step on Web Designing</h1>
			<p>
				Start making and designing website with Wizely and let your creativity be known.
			</p>
			<p>
				Enjoy designing and do the tasks <br>
				IT'S FREE WITH NEW TOPICS WEEKLY!
			</p>
		</div>
		<div class="html">
			<h2>Example of HTML</h2>
			<img src="assets/html.png" title="This is an example of HTML">
		</div>
		<div class="css">
			<h2>Example of CSS</h2>
			<img src="assets/css.png" title="This is an example of CSS">
		</div>
	</main>
	<section id="icons">
		<!--section for the inserted images-->
		<div>
			<img src="assets/icon.png" title="HTML icon">
			<p>The standard markup language for documents designed to be displayed in a web browser</p>
		</div>
		<div>
			<img src="assets/icon1.png" title="CSS icon">
			<p>A style sheet language used for describing the presentation of a document written in a markup language</p>
		</div>
		<div>
			<img src="assets/icon2.png" title="Web designing icon">
			<p>Web designing is the process of planning, conceptualizing, and arranging content online</p>
		</div>
	</section>
	<!--FOOTER-->
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
			<!--facebook icon-->
			<a href="#" class="fa fa-twitter" title="Twitter"></a>
			<!--twitter icon-->
			<a href="#" class="fa fa-linkedin" title="LinkedIn"></a>
			<!--linkedin icon-->
		</section>
		<div>
			<p><span>WIZELY</span> Web Design &copy; 2021</p>
		</div>
	</footer>
</body>

</html>

<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>