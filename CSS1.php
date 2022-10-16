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

	<title>All About CSS | Introduction</title>
	<link rel="stylesheet" href="CSS/CSS1.css">
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
				<a class="list-group-item list-group-item-action active" href="CSS1.php">CSS Introduction</a>
				<a class="list-group-item list-group-item-action" href="formatting.php">CSS Formatting</a>
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
				<div class="css">
					<h1>What is CSS?</h1>
					<ul type="disc">
						<li>Stands for Cascading Style Sheets</li>
						<li>Cascading refers to the way CSS applies one style</li>
						<li>Style Sheets control the look and feel of web documents</li>
						<li>CSS and HTML work hand in hand:
							<ol type="a">
								<li>HTML sorts out the page structure</li>
								<li>CSS defines how HTML elements are displayed</li>
							</ol>
						</li>
					</ul>
				</div>
				<div class="css">
					<h2>This is a CSS</h2>
					<textarea disabled>
									body{
										font-family: Arial, Helvetica, sans-serif;
										font-size: 15px;
										background-color: #f3f3f3;
										text-align: center;
									}
								</textarea>
				</div>
				<div class="css">
					<h1>Why Use CSS?</h1>
					<ul type="disc">
						<li>allows you to apply specific styles to specific HTML elements</li>
						<li>allows you to separate the style from content</li>
						<li>Style Sheets control the look and feel of web documents</li>
					</ul>
				</div>
				<div>
					<h1>Ways to Insert Style Sheet</h1>
					<ol type="a">
						<li>Inline CSS
							<ul type="disc">
								<li>a unique style is applied to a single element</li>
								<li>in order to use it, add the style attribute to the relevant tag</li>
							</ul>
						</li>
						<li>Embedded or Internal CSS
							<ul type="disc">
								<li>defined within the &lt;style&gt; element,
									inside the head section of an HTML page</li>
								<li>this CSS file is then referenced in the HTML using the
									&lt;link&gt; tag which
									goes inside the head section</li>
							</ul>
						</li>
						<li>External CSS
							<ul type="disc">
								<li>all styling rules are contained in a single text file</li>
								<li>maybe used if one single page has a unique style</li>
							</ul>
						</li>
					</ol>
				</div>

				<div class="example">
					<h3>This is an Inline CSS:</h3>
					<div>
						&lt;p <span style="color: cadetblue;">style</span>="<span style="color: red;">color</span>:
						<span style="color: blue;">white</span>; <span style="color: red;">background-color</span>:
						<span style="color: blue;">gray</span>;"&gt;<br>
						&nbsp; &nbsp; &nbsp;This is an example of inline styling<br>
						&lt;/p&gt;
					</div>
				</div>


				<div class="example">
					<h3>This is an Internal CSS:</h3>
					<div>
						&lt;html&gt; <br>
						&nbsp; &nbsp;&lt;head&gt; <br>
						&nbsp; &nbsp; &nbsp;&nbsp;&lt;style&gt;<br>
						&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;p {<br>
						&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;<span style="color: red;">color</span>:
						<span style="color: blue;">white</span>;<span style="color: red;">background-color</span>:
						<span style="color: blue;">gray</span>;<br>
						&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;}
						<br>
						&nbsp; &nbsp; &nbsp;&nbsp;&lt;/style&gt; <br>
						&nbsp; &nbsp;&lt;/head&gt; <br>
						&nbsp; &nbsp;&lt;body&gt; <br>
						&nbsp; &nbsp;&lt;p&gt;<br>
						&nbsp; &nbsp;&nbsp; &nbsp;This is my first paragraph <br>
						&nbsp; &nbsp;&lt;/p&gt; <br>
						&nbsp; &nbsp;&lt;p&gt;<br>
						&nbsp; &nbsp;&nbsp; &nbsp;This is my second paragraph <br>
						&nbsp; &nbsp;&lt;/p&gt; <br>
						&nbsp; &nbsp;&lt;/body&gt; <br>
						&lt;/html&gt;
					</div>
				</div>

				<div class="example">
					<h3>This is an External CSS:</h3>
					<div>
						<h3>The HTML:</h3>
						&lt;html&gt; <br>
						&nbsp; &nbsp;&lt;head&gt; <br>
						&nbsp; &nbsp; &nbsp;&lt;link rel="<span style="color: yellowgreen;">stylesheet</span>"
						type="text/css" href="<span style="color: yellowgreen;">examples.css</span>"&gt;<br>
						&nbsp; &nbsp;&lt;/head&gt; <br>
						&nbsp; &nbsp;&lt;body&gt; <br>
						&nbsp; &nbsp;&lt;p&gt;This is my first paragraph&lt;/p&gt; <br>
						&nbsp; &nbsp;&lt;p&gt;This is my second paragraph&lt;/p&gt; <br>
						&nbsp; &nbsp;&lt;/body&gt; <br>
						&lt;/html&gt;

						<h3>The CSS:</h3>
						p { <br>
						&nbsp; &nbsp;<span style="color: red;">color</span>:
						<span style="color: blue;">white</span>;<br>
						&nbsp; &nbsp;<span style="color: red;">background-color</span>:
						<span style="color: blue;">gray</span>; <br>
						}
					</div>
				</div>

				<div class="syntax">
					<h1>CSS SYNTAX</h1>
					<p>
						CSS is composed of style rules that the browser interprets
						and then applies to the corresponding elements in your document
					</p>
					<p>
						a style rule has 2 main parts: a selector, and one or more declarations:
					</p>
					<img src="assets/css-syntax.png" alt="css-syntax.png" title="This is the CSS Syntax">
					<ul>
						<li>the <span style="color: teal;font-weight: bolder;">selector</span> points to the HTML element you want to style</li>
						<li>the <span style="color: teal;font-weight: bolder;">declaration</span> block contains one or more declarations separated by semicolons(;)</li>
						<li>each declaration includes a CSS property <span style="color: teal;font-weight: bolder;">name</span>
							and a <span style="color: teal;font-weight: bolder;">value</span>, separated by a
							<span style="color: teal;font-weight: bolder;">colon</span>
						</li>
						<li>a CSS declaration always ends with a
							<span style="color: teal;font-weight: bolder;">semicolon</span>,
							and declaration blocks are surrounded by
							<span style="color: teal;font-weight: bolder;">curly braces</span>
						</li>
					</ul>
					<div>
						<h3>EXAMPLE</h3>
						p { <br>
						&nbsp; &nbsp;<span style="color: blue;">color</span>:
						<span style="color: red;">red</span>;<br>
						&nbsp; &nbsp;<span style="color: blue;">text-align</span>:
						<span style="color:red;">center</span>; <br>
						}
					</div>
				</div>

				<br>
				<button id="next"><a href="formatting.php">NEXT</a></button>


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
	</section>
</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>