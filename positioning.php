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

	<title>All About CSS | Positioning</title>
	<link rel="stylesheet" href="CSS/positions.css">
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

	<div class="row">
		<div class="col-2">
			<div class="list-group" id="list-tab" role="tablist">
				<a href="#" class="fa fa-bars"></a>
				<a class="list-group-item list-group-item-action" href="CSS1.php">CSS Introduction</a>
				<a class="list-group-item list-group-item-action" href="formatting.php">CSS Formatting</a>
				<a class="list-group-item list-group-item-action active" href="positioning.php">CSS Positioning</a>
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
				<div class="positioning">
					<h1>CSS POSITION</h1>
					<p>The position property specifies the type of positioning method
						used for an element (static, relative, fixed, absolute or sticky).
					</p>
					<p>Five different position values:</p>
					<ul>
						<li>static</li>
						<li>relative</li>
						<li>fixed</li>
						<li>absolute</li>
						<li>sticky</li>
					</ul>
					<div>
						<h3><span style="color:blue">position</span>: <span style="color:coral">static;</span></h3>
						<p>Static positioned elements are not affected by the top, bottom, left, and right properties.</p>
					</div>
					<div>
						<h3><span style="color:blue">position</span>: <span style="color:coral">relative;</span></h3>
						<p>An element with position: relative; is positioned relative to its normal position</p>
					</div>
					<div>
						<h3><span style="color:blue">position</span>: <span style="color:coral">fixed;</span></h3>
						<p>An element with position: fixed; is positioned relative to the viewport,
							which means it always stays in the same place even if the page is scrolled.
							The top, right, bottom, and left properties are used to position the element.</p>
					</div>
					<div>
						<h3><span style="color:blue">position</span>: <span style="color:coral">absolute;</span></h3>
						<p>An element with position: absolute; is positioned relative to the nearest positioned
							ancestor (instead of positioned relative to the viewport, like fixed).</p>
					</div>
					<div>
						<h3><span style="color:blue">position</span>: <span style="color:coral">sticky;</span></h3>
						<p>An element with position: sticky; is positioned based on the user's scroll position.</p>
					</div>

				</div>
				<br>
				<br>
				<button id="previous"><a href="formatting.php">PREVIOUS</a></button>
				<button id="next"><a href="addedcss.php">NEXT</a></button>
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