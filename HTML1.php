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

	<title>All About HTML | Introduction</title>
	<link rel="stylesheet" href="CSS/HTML.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
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
				<a class="list-group-item list-group-item-action active" href="HTML1.php">HTML Introduction</a>
				<a class="list-group-item list-group-item-action" href="tags-elements.php">HTML Tags and Elements</a>
				<a class="list-group-item list-group-item-action" href="colors.php">HTML Colors</a>
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
				<div class="html">
					<h1>What is HTML?</h1>
					<ul type="disc">
						<li>HTML stands for Hyper Text Markup Language</li>
						<li>HTML is the standard markup language for creating Web pages</li>
						<li>HTML describes the structure of a Web page</li>
					</ul>
					<div class="trial">
						<div id="trial">
							<h3>EXAMPLE 1</h3>
							<!--Printed as plaintext on the browser-->
							<textarea disabled>
								<html>
								<head>
									<title>My First Page</title>
								</head>
								<body>
									Hello World
								</body>
								</html> 
							</textarea>
						</div>
						<div id="trial">
							<h3>EXAMPLE 2</h3>
							<!--Printed as plaintext on the browser-->
							<textarea disabled>
								<html>
								<head>
									<title>My First Page</title>
								</head>
								<body>
									<p>This is a paragraph</p>
									<p><i>This paragraph is italized</i></p>
								</body>
								</html> 
							</textarea>
						</div>
						<textarea id="description" disabled>
								<!DOCTYPE html>is the declaration for HTML5.
									<html> tag represents the root of an HTML document.
										<head> Contains all of the non-visual elements that help make the page work.
											<title> To place a title on the tab describing the web page.
												<body>All visual-structural elements are container.
													<p> represents a paragraph.
														<i> it sets the content inside in italic
							</textarea>
						<hr>
						<div class="about">
							<div id="about">
								<h4>HTML EDITORS</h4>
								<ul>
									<li>Notepad</li>
									<li>Wordpad</li>
									<li>Microsoft Word</li>
									<li>Microsoft Visual Web Developer</li>
									<li>AdobeDreamweaver</li>
									<li>WeBuilder</li>
									<li>Visual Studio Code</li>
									<li>TextEdit</li>
									<li>iWeb</li>
									<li>Pages</li>
								</ul>
							</div>
							<div id="about">
								<h4>WEB BROWSERS</h4>
								<ul>
									<li>Apple Safari</li>
									<li>Microsoft Internet</li>
									<li>Explorer</li>
									<li>Mozilla Firefox</li>
									<li>Google Chrome</li>
									<li>Konqueror</li>
									<li>OmniWeb</li>
									<li>Opera</li>
									<li>Netscape</li>
								</ul>
							</div>
							<div id="about">
								<h4>HTML VERSIONS</h4>
								<table>
									<tr>
										<td>HTML</td>
										<td>1991</td>
									</tr>
									<tr>
										<td>HTML 2.0</td>
										<td>1995</td>
									</tr>
									<tr>
										<td>HTML 3.2</td>
										<td>1997</td>
									</tr>
									<tr>
										<td>HTML 4.01</td>
										<td>1999</td>
									</tr>
									<tr>
										<td>XHTML</td>
										<td>2000</td>
									</tr>
									<tr>
										<td>HTML5</td>
										<td>2014</td>
									</tr>
									<tr>
										<td>HTML 5.1</td>
										<td>2016</td>
									</tr>
									<tr>
										<td>HTML 5.2</td>
										<td>2017</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<button id="next"><a href="tags-elements.php">NEXT</a></button>
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