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

	<title>All About CSS | Formatting</title>
	<link rel="stylesheet" href="CSS/format.css">
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
				<a class="list-group-item list-group-item-action" href="CSS1.php">CSS Introduction</a>
				<a class="list-group-item list-group-item-action active" href="formatting.php">CSS Formatting</a>
				<a class="list-group-item list-group-item-action" href="positioning.php">CSS Positioning</a>
				<a class="list-group-item list-group-item-action" href="addedcss.php"></a>
				<?php
				$sql = "SELECT * FROM lessons WHERE Category='CSS Lesson'";
				$stmt = $conn->query($sql);
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<a class="list-group-item list-group-item-action" href="addedcss.php">
						<?php echo $row['lessonName'] ?>
					</a>

				<?php } ?>
			</div>
		</div>
		<div class="col-10" style="background-color: #f3f3f3;">
			<div class="tab-content" id="nav-tabContent">
				<div class="formatting">
					<h1>TEXT COLOR</h1>
					<p>The color property is used to set the color of the text. The color is specified by:
					</p>
					<ul>
						<li>a color name - like "red"</li>
						<li>a HEX value - like "#ff0000"</li>
						<li>The default text color for a page is defined in the body selector</li>
					</ul>
					<div>
						<h3>EXAMPLE</h3>
						body { <br>
						&nbsp;&nbsp;<span style="color:blue">color</span>: <span style="color:tomato">blue</span>;
						<br>
						&nbsp;} <br>
						h1 { <br>
						&nbsp;&nbsp;<span style="color: blue;">color</span>: <span style="color:tomato">green</span>;
						<br>
						&nbsp;}
					</div>
				</div>
				<div class="formatting">
					<h1>TEXT ALIGNMENT</h1>
					<p>The text-align property is used to set the horizontal alignment of a text.
					</p>
					<p>A text can be left or right aligned, centered, or justified.</p>
					<p>The following example shows center aligned, and left and right aligned text
						(left alignment is default if text direction is left-to-right, and right
						alignment is default if text direction is right-to-left):</p>
					<div>
						<h3>EXAMPLE</h3>
						h1 { <br>
						&nbsp;&nbsp;<span style="color:blue">text-align</span>: <span style="color:tomato">center</span>;
						<br>
						&nbsp;} <br>
						h2
						&nbsp;{ <br>
						&nbsp;&nbsp;<span style="color: blue;">text-align</span>: <span style="color:tomato">left</span>;
						<br>
						&nbsp;} <br>
						h3
						&nbsp;{ <br>
						&nbsp;&nbsp;<span style="color: blue;">text-align</span>: <span style="color:tomato">right</span>;
						<br>
						&nbsp;}
					</div>
				</div>

				<div class="formatting">
					<h1>TEXT DECORATION</h1>
					<p>The text-decoration property is used to set or remove decorations from text..
					</p>
					<p>The value text-decoration: none; is often used to remove underlines from links:</p>
					<div>
						<h3>EXAMPLE</h3>
						a
						&nbsp; { <br>
						&nbsp;&nbsp;<span style="color:blue">text-decoration</span>:
						<span style="color:tomato">none</span>;
						<br>
						&nbsp;} <br>
					</div>
				</div>

				<div class="formatting">
					<h1>TEXT TRANSFORM</h1>
					<p>The text-transform property is used to specify uppercase and lowercase letters in a text.
					</p>
					<p>It can be used to turn everything into uppercase or lowercase letters, or capitalize the first letter of each word:</p>
					<div>
						<h3>EXAMPLE</h3>
						p.uppercase { <br>
						&nbsp;&nbsp;<span style="color:blue">text-transform</span>:
						<span style="color:tomato">uppercase</span>;
						<br>
						&nbsp;} <br>
						p.lowercase { <br>
						&nbsp;&nbsp;<span style="color:blue">text-transform</span>:
						<span style="color:tomato">lowercase</span>;
						<br>
						&nbsp;} <br>
						p.capitalize { <br>
						&nbsp;&nbsp;<span style="color:blue">text-transform</span>:
						<span style="color:tomato">capitalize</span>;
						<br>
						&nbsp;}
					</div>
				</div>
				<br>
				<br>
				<button id="previous"><a href="CSS1.php">PREVIOUS</a></button>
				<button id="next"><a href="positioning.php">NEXT</a></button>
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