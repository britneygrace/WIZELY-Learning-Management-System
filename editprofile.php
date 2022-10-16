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
//Edit Profile
if (isset($_POST['saveProfile'])) {
    $sql = "UPDATE users SET name=:name, email=:email, password=:pword WHERE ID=:update_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['update_name'],
        ':email' => $_POST['update_email'],
        ':pword' => $_POST['update_password'],
        ':update_id' => $_POST['uid']
    ]);
    header("location: editProfile.php");
}
//upload display picture
if (isset($_POST['savePicture'])) {

    $Get_image_name = $_FILES['update_picture']['name'];
    $image_Path = "upload/" . basename($Get_image_name);
    $Get_file_name = $_FILES['update_picture']['name'];
    $file_Path = "upload/" . basename($Get_file_name);

    $sql = "UPDATE users SET profile_pic=:pic WHERE ID=:up_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':pic' => $_FILES['update_picture']['name'],
        ':up_id' => $_POST['upid']
    ]);

    if (move_uploaded_file($_FILES['update_picture']['tmp_name'], $image_Path)) {
    }
    header("location: editProfile.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>WIZELY | MY PROFILE</title>
    <link rel="stylesheet" href="CSS/profile.css">
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
                    <a class="nav-link" href="Tasks.php">TASKS</a>
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

    <?php
    $sql = "SELECT * FROM users WHERE name='$login_user'";
    $stmt = $conn->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <form class="form w-75">
            <div class="form-group">
                <?php if (empty($row['profile_pic'])) { ?>
                    <div class="picnull"></div>
                <?php } else { ?>
                    <?php echo '<img src="upload/' . $row['profile_pic'] . '"<br> <br>' ?>
                <?php } ?>
                <a data-toggle="modal" data-target="#editPic" href="#" onclick="getPicture(<?php echo $row['ID'] ?>,'<?php echo $row['profile_pic'] ?>');">Edit Display Picture</a>
            </div>

            <div class="form-group">
                <input disabled type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
            </div>
            <div class="form-group">

                <input disabled type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">

            </div>
            <div class="form-group">

                <input disabled type="password" class="form-control" name="password" value="<?php echo $row['password'] ?>">
            </div>

            <br>
            <div class="form-group text-center">
                <button type="button" name="editProfile" class="btn btn-outline-primary w-50" data-toggle="modal" data-target="#editModal" onclick="getUserDetails(<?php echo $row['ID'] ?>,'<?php echo $row['name'] ?>','<?php echo $row['email'] ?>','<?php echo $row['password'] ?>');">Edit</button>
            </div>
        </form>
    <?php } ?>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Profile Details</h5>
                </div>
                <?php
                $sql = "SELECT * FROM users WHERE name='$login_user'";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name:</label>
                                    <input type="text" name="update_name" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label">E-mail:</label>
                                    <input type="email" name="update_email" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password:</label>
                                    <input type="password" name="update_password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="saveProfile">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="hidden" name="uid" id="upid">
                        </div>
            </div>
            </form>
        <?php } ?>

        </div>
    </div>
    </div>
    <!-- Modal For Uploading Display Picture -->
    <div class="modal fade" id="editPic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Display Picture</h5>
                </div>
                <?php
                $sql = "SELECT * FROM users WHERE name='$login_user'";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="update_picture" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="savePicture">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="hidden" name="upid" id="upId">
                        </div>
            </div>
            </form>
        <?php } ?>

        </div>
    </div>
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
    </footer>
    </section>

</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>

<script>
    function getUserDetails(id, name, email, pwd, image) {
        $('#upid').val(id);
        $('input[name="update_name"]').val(name);
        $('input[name="update_email"]').val(email);
        $('input[name="update_password"]').val(pwd);
        $('input[name="update_image"]').val(image);

    }

    function getPicture(Id, img) {
        $('#upId').val(Id);
        $('input[name="update_picture"]').val(img);

    }
</script>