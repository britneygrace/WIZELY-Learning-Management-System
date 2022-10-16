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
    <title>All About HTML </title>
    <link rel="stylesheet" href="CSS/addedhtml.css">
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
                <a class="list-group-item list-group-item-action" href="colors.php">HTML Colors</a>
                <a class="list-group-item list-group-item-action active" id="list-lessons-list" data-toggle="list" href="#dash" role="tab" aria-controls="settings"></a>
                <?php
                $sql = "SELECT * FROM lessons WHERE Category='HTML Lesson'";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                    <?php
                    $id = $row['lessonName'];
                    $t_id = str_replace(" ", "", $id);
                    ?>

                    <a class="list-group-item list-group-item-action" id="list-lessons-list" data-toggle="list" href="<?php echo '#' . $t_id ?>" role="tab" aria-controls="settings">
                        <?php echo $row['lessonName'] ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="col-10" style="background-color: #f3f3f3;">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="dash" role="tabpanel" aria-labelledby="list-lessons-list">
                    <h3><i style="color:#e8491d;">Wizely is Updating...</i></h3>
                </div>
                <?php
                $sql = "SELECT * FROM lessons WHERE Category='HTML Lesson'";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                    <?php
                    $id = $row['lessonName'];
                    $t_id = str_replace(" ", "", $id);
                    ?>
                    <div class="tab-pane fade" id="<?php echo $t_id ?>" role="tabpanel" aria-labelledby="list-lessons-list">

                        <?php if (!empty($row['title1'])) { ?>
                            <h1><?php echo $row['title1']; ?></h1>
                            <p><?php echo nl2br($row['description1']); ?></p>
                            <h6><?php echo nl2br($row['info1']); ?></h6>
                            <?php if (!empty($row['example1'])) { ?>
                                <h4>Example:</h4>
                                <textarea id="example1" disabled>
                            <?php echo $row['example1']; ?>
                            </textarea>
                                <h4>Output:</h4>
                                <div id="output"><?php echo nl2br($row['example1']); ?></div>
                            <?php } ?>
                        <?php } ?>

                        <?php if (!empty($row['title2'])) { ?>
                            <hr>
                            <h1><?php echo $row['title2']; ?></h1>
                            <p><?php echo nl2br($row['description2']); ?></p>
                            <h6><?php echo nl2br($row['info2']); ?></h6>
                            <?php if (!empty($row['example2'])) { ?>
                                <h4>Example:</h4>
                                <textarea id="example2" disabled>
                            <?php echo $row['example2']; ?>
                            </textarea>
                                <h4>Output:</h4>
                                <div id="output"><?php echo  nl2br($row['example2']); ?></div>
                            <?php } ?>
                        <?php } ?>

                        <?php if (!empty($row['title3'])) { ?>
                            <hr>
                            <h1><?php echo $row['title3']; ?></h1>
                            <p><?php echo nl2br($row['description3']); ?></p>
                            <h6><?php echo nl2br($row['info3']); ?></h6>
                            <?php if (!empty($row['example3'])) { ?>
                                <h4>Example:</h4>
                                <textarea id="example3" disabled>
                            <?php echo $row['example3']; ?>
                            </textarea>
                                <h4>Output:</h4>
                                <div id="output"><?php echo  nl2br($row['example3']); ?></div>
                            <?php } ?>
                        <?php } ?>

                        <?php if (!empty($row['title4'])) { ?>
                            <hr>
                            <h1><?php echo $row['title4']; ?></h1>
                            <p><?php echo nl2br($row['description4']); ?></p>
                            <h6><?php echo nl2br($row['info4']); ?></h6>
                            <?php if (!empty($row['example4'])) { ?>
                                <h4>Example:</h4>
                                <textarea id="example4" disabled>
                            <?php echo $row['example4']; ?>
                            </textarea>
                                <h4>Output:</h4>
                                <div id="output"><?php echo  nl2br($row['example4']); ?></div>
                            <?php } ?>
                        <?php } ?>

                        <?php if (!empty($row['title5'])) { ?>
                            <hr>
                            <h1><?php echo $row['title5']; ?></h1>
                            <p><?php echo nl2br($row['description5']); ?></p>
                            <h6><?php echo ($row['info5']); ?></h6>
                            <?php if (!empty($row['example5'])) { ?>
                                <h4>Example:</h4>
                                <textarea id="example5" disabled>
                            <?php echo $row['example5']; ?>
                            </textarea>
                                <h4>Output:</h4>
                                <div id="output"><?php echo  nl2br($row['example5']); ?></div>
                            <?php } ?>
                        <?php } ?>

                    </div>
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

</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>