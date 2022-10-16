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

	<title>All About HTML | Colors</title>
	<link rel="stylesheet" href="CSS/color.css">
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
				<li class="nav-item dropdown active">
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


	<div class="row">
		<div class="col-2">
			<div class="list-group" id="list-tab" role="tablist">
				<a href="#" class="fa fa-bars"></a>
				<a class="list-group-item list-group-item-action" href="HTML1.php">HTML Introduction</a>
				<a class="list-group-item list-group-item-action" href="tags-elements.php">HTML Tags and Elements</a>
				<a class="list-group-item list-group-item-action active" href="colors.php">HTML Colors</a>
				<a class="list-group-item list-group-item-action" href="addedhtml.php"></a>
				<?php
				$sql = "SELECT * FROM lessons WHERE Category='HTML Lesson'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>

					<?php
					$id = $row['lessonName'];
					$t_id = str_replace(" ", "", $id);
					?>

					<a class="list-group-item list-group-item-action" href="addedhtml.php">
						<?php echo $row['lessonName'] ?>
					</a>
				<?php } ?>
			</div>
		</div>
		<div class="col-10" style="background-color: #f3f3f3;">
			<div class="tab-content" id="nav-tabContent">
				<div class="colors">
					<h1>HTML COLORS</h1>
					<p>HTML Colors are specified with predefined color names, or
						with RGB, HEX, HSL, RGBA, or HSLA values.</p>
					<h2 id="name">Color Names</h2>
					<p>In HTML, a color can be specified by using a color name:</p>
					<div id="pink">
						PINK
					</div>
					<div id="yellow">
						YELLOW
					</div>
					<div id="blue">
						BLUE
					</div>
					<div id="green">
						GREEN
					</div>
					<div id="purple">
						PURPLE
					</div>
					<h3>TRIAL</h3>
					<textarea id="trial">
										<h4 style="background-color: pink;color:black">PINK</h4>
										<h4 style="background-color: yellow;color:black">YELLOW</h4>
										<h4 style="background-color: blue;color:white">BLUE</h4>
										<h4 style="background-color: green;color:white">GREEN</h4>
										<h4 style="background-color: purple;color:white">PURPLE</h4>
									</textarea>
					<hr>
					<p id="background" style="background-color: coral;color: white;">Background Color</p>
					<p>You can set the background color for HTML elements:</p>

					<h4 id="wizely" style="background-color: #35424a;color:#ffffff">WIZELY Web Design</h4>
					<p id="sample" style="background-color: #cccccc; color: #000000;">Lorem ipsum dolor sit amet consectetur adipisicing elit.
						Corporis fugiat error dolorem dignissimos autem consectetur
						porro quis quasi pariatur voluptates vitae similique unde
						sapiente itaque dolor saepe sit, aperiam delectus.</p>
					<h3>TRIAL</h3>
					<textarea id="trial">
										<h4 style="background-color: #35424a;color:#ffffff">WIZELY Web Design</h4>
											<p id="sample" style="background-color: #cccccc; color: #000000;">Lorem ipsum...</p>
									</textarea>
					<hr>

					<h2>Text Color</h2>
					<p>You can set the color of text:</p>
					<h4 id="text">WIZELY Web Design</h4>
					<p id="color">Lorem ipsum dolor sit amet consectetur adipisicing elit.
						Corporis fugiat error dolorem dignissimos autem consectetur
						porro quis quasi pariatur voluptates vitae similique unde
						sapiente itaque dolor saepe sit, aperiam delectus.
					</p>
					<h3>TRIAL</h3>
					<textarea id="trial">
										<h4 style="color:tomato">WIZELY Web Design</h4>
											<p id="sample" style="color: blue;">Lorem ipsum...</p>
									</textarea>
					<hr>

					<h2>Color Values</h2>
					<p>In HTML, colors can also be specified using RGB values, HEX values,
						HSL values, RGBA values, and HSLA values.:</p>
					<div id="rgb">rgb(255, 99, 71)</div>
					<div id="hex">#ff6347</div>
					<div id="hsl">hsl(9, 100%, 64%)</div>

					<h3>TRIAL</h3>
					<textarea id="trial">
										<h4 style="background-color:rgb(255, 99, 71);">rgb(255, 99, 71)</h4>
										<h4 style="background-color:#ff6347;">#ff6347</h4>
										<h4 style="background-color:hsl(9, 100%, 64%);">hsl(9, 100%, 64%)</h4>
									</textarea>
					<hr>
					<br>
					<button id="previous"><a href="tags-elements.php">PREVIOUS</a></button>
					<button id="next"><a href="addedhtml.php">NEXT</a></button>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
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
			<a href="#" class="fa fa-twitter" title="Twitter"></a>
			<a href="#" class="fa fa-linkedin" title="LinkedIn"></a>
		</section>

		<div>
			<p><span>WIZELY</span> Web Design &copy; 2021</p>
		</div>
	</footer>
</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>