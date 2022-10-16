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

  <title>WIZELY | TASKS</title>
  <link rel="stylesheet" href="CSS/task.css">
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
        <li class="nav-item active">
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
  <div class="container mb-3 pt-3">
    <?php
    $sql = "SELECT * FROM task ORDER BY title";

    $stmt = $conn->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>

      <!-- Button trigger modal -->
      <?php
      $id = $row['title'];
      $t_id = str_replace(" ", "", $id);
      ?>
      <button type="button" class="btn btn-outline-info w-50" data-toggle="modal" data-target="<?php echo '#' . $t_id ?>" style="display:block;font-size:30px;margin-left:25%;margin-bottom:20px">
        <?php echo $row['title'] ?>
      </button>

      <!-- Modal -->
      <div class="modal fade" id="<?php echo $t_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%; height:max-content">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['title'] ?></h5>
            </div>
            <div class="modal-body">
              <h5><?php echo $row['description']; ?></h5>
              <a href="#" id="pop">
                <?php echo '<img id="imgsrc" src="upload/' . $row['image'] . '" style="width: 100%;"> <br>' ?>
              </a>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <?php $row['file'];
              if (!empty($row['file'])) { ?>
                <a class="btn btn-primary" role="button" <?php $row['file'];
                                                          echo 'href="upload/' . $row['file'] . '"' ?> target="_blank">Download</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

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

    </section>
  </footer>

</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>