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

    <title>All About HTML | Tags and Elements</title>
    <link rel="stylesheet" href="CSS/tagselements.css">
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
                <a class="list-group-item list-group-item-action active" href="tags-elements.php">HTML Tags and Elements</a>
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
                <div class="tags-elements">
                    <h3>TAGS</h3>
                    <li>An HTML tag is a special word or letter surrounded by angle brackets <q>&lt; &gt;</q></li>
                    <li>Tags are used to create HTML elements, such as paragraphs or links</li>

                    <div class="tags-elements">
                        <h3>ELEMENTS</h3>
                        <li>HTML Element is an individual component of an HTML document</li>
                        <li>The HTML element is everything from the start tag to the end tag</li>
                        <li>It represents semantics, or meaning</li>
                    </div>

                    <div class="common-tags">
                        <table>
                            <caption>Commonly Used Tags in HTML Document</caption>
                            <tr id="head">
                                <td>Start Tag</td>
                                <td>Description</td>
                                <td>End Tag</td>
                            </tr>
                            <tr>
                                <td>&lt;html&gt;</td>
                                <td>the root of the HTML doument which is used to specify that the document is html</td>
                                <td>&lt;/html&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;head&gt;</td>
                                <td>contains all of the non-visual elements
                                    that help make the page work</td>
                                <td>&lt;/head&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;title&gt;</td>
                                <td>used to place a title on the tab describing the web page</td>
                                <td>&lt;/title&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;body&gt;</td>
                                <td>defines the main content of the HTML document</td>
                                <td>&lt;/body&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;div&gt;</td>
                                <td>defines the division of content</td>
                                <td>&lt;/div&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;p&gt;</td>
                                <td>used to define paragraph content in html document</td>
                                <td>&lt;/p&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;em&gt;</td>
                                <td>used to renders as emphasized text</td>
                                <td>&lt;/em&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;b&gt;</td>
                                <td>used to specify bold content</td>
                                <td>&lt;/b&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;i&gt;</td>
                                <td>used to make the content in italic format</td>
                                <td>&lt;/i&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;u&gt;</td>
                                <td>used to set the content underlined</td>
                                <td>&lt;/u&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;a href&gt;</td>
                                <td>used to link one page to another page</td>
                                <td>&lt;/a&gt;</td>
                            </tr>
                            <tr>
                                <td>&lt;!----&gt;</td>
                                <td>used to set comment in the html document which is not visible on the browser</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&lt;br&gt;</td>
                                <td>an empty tag that is used to break the line</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&lt;hr&gt;</td>
                                <td>an empty tag that is used to display a horizontal line</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="elements-examples">
                        <h2>EXAMPLE OF NESTED HTML ELEMENTS</h2>
                        <textarea disabled>
                                    <!DOCTYPE html>
                                    <html>
                                        <head>
                                            <title>Nested Elements</title>
                                        </head>
                                        <body>
                                            <h1>This is <i>italic</i> heading</h1>
                                            <p>This is a paragraph.</p>
                                            <p><u>This is underlined paragraph.</u></p>
                                            <p><b>This is a bold paragraph.</b></p>
                                        </body>
                                        </html>
                                </textarea>
                        <img src="assets/sample.png" alt="sample.png" title="EXAMPLE OF NESTED HTML ELEMENTS">
                    </div>
                </div>
                <br>
                <button id="previous"><a href="HTML1.php">PREVIOUS</a></button>
                <button id="next"><a href="colors.php">NEXT</a></button>
                <br>
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