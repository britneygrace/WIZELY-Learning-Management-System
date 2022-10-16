<?php
session_start();
include("config.php");

if (!isset($_SESSION['user'])) {
    header("location: LoginPage.php");
}
$user_check = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE email='$user_check'";
$stmt = $conn->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$login_user = $row['name'];
$login_access = $row['acct_type'];
//code to add Wizely Lesson
if (isset($_POST['addLessons'])) {
    $sql = "INSERT INTO lessons (Category, lessonName, title1, title2, title3, title4, title5, 
    description1, description2, description3, description4, description5,
    info1, info2, info3, info4, info5, example1, example2, example3, example4, example5)
    VALUES (:cat, :lesson, :ttl1, :ttl2, :ttl3, :ttl4, :ttl5, :desc1, :desc2, :desc3, :desc4, :desc5, :in1, :in2, :in3, :in4, :in5, :ex1, :ex2, :ex3, :ex4, :ex5)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':cat' => $_POST['category'],
        ':lesson' => $_POST['lessonName'],
        ':ttl1' => $_POST['title1'],
        ':ttl2' => $_POST['title2'],
        ':ttl3' => $_POST['title3'],
        ':ttl4' => $_POST['title4'],
        ':ttl5' => $_POST['title5'],
        ':desc1' => $_POST['desc1'],
        ':desc2' => $_POST['desc2'],
        ':desc3' => $_POST['desc3'],
        ':desc4' => $_POST['desc4'],
        ':desc5' => $_POST['desc5'],
        ':in1' => $_POST['info1'],
        ':in2' => $_POST['info2'],
        ':in3' => $_POST['info3'],
        ':in4' => $_POST['info4'],
        ':in5' => $_POST['info5'],
        ':ex1' => $_POST['example1'],
        ':ex2' => $_POST['example2'],
        ':ex3' => $_POST['example3'],
        ':ex4' => $_POST['example4'],
        ':ex5' => $_POST['example5']
    ]);
    echo '<script>alert("Lesson Added!")</script>';
}
//code to edit lesson info
if (isset($_POST['save_data'])) {
    $sql = "UPDATE lessons SET title1=:ttl1, title2=:ttl2, title3=:ttl3, title4=:ttl4, title5=:ttl5, 
    description1=:desc1, description2=:desc2, description3=:desc3, description4=:desc4, description5=:desc5,
    info1=:in1, info2=:in2, info3=:in3, info4=:in4, info5=:in5, example1=:ex1, example2=:ex2, example3=:ex3, example4=:ex4, example5=:ex5 WHERE lessonID=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':ttl1' => $_POST['title1'],
        ':ttl2' => $_POST['title2'],
        ':ttl3' => $_POST['title3'],
        ':ttl4' => $_POST['title4'],
        ':ttl5' => $_POST['title5'],
        ':desc1' => $_POST['desc1'],
        ':desc2' => $_POST['desc2'],
        ':desc3' => $_POST['desc3'],
        ':desc4' => $_POST['desc4'],
        ':desc5' => $_POST['desc5'],
        ':in1' => $_POST['info1'],
        ':in2' => $_POST['info2'],
        ':in3' => $_POST['info3'],
        ':in4' => $_POST['info4'],
        ':in5' => $_POST['info5'],
        ':ex1' => $_POST['example1'],
        ':ex2' => $_POST['example2'],
        ':ex3' => $_POST['example3'],
        ':ex4' => $_POST['example4'],
        ':ex5' => $_POST['example5'],
        ':id' => $_POST['update_Id']
    ]);
    echo '<script>alert("Lesson Saved!")</script>';
}
//code to add task
if (isset($_POST['addTask'])) {
    $Get_image_name = $_FILES['add_image']['name'];
    $image_Path = "upload/" . basename($Get_image_name);
    $Get_file_name = $_FILES['add_file']['name'];
    $file_Path = "upload/" . basename($Get_file_name);

    $sql = "INSERT INTO task (title, description, image, file) VALUES (:ttl, :des, :img, :file)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':ttl' => $_POST['add_title'],
        ':des' => $_POST['add_description'],
        ':img' => $_FILES['add_image']['name'],
        ':file' => $_FILES['add_file']['name']
    ]);

    if (move_uploaded_file($_FILES['add_image']['tmp_name'], $image_Path)) {
        echo '<script>alert("Task Added!")</script>';
    }
    if (move_uploaded_file($_FILES['add_file']['tmp_name'], $file_Path)) {
        echo '<script>alert("Task Added!")</script>';
    }
}
//code to delete task
if (isset($_POST['delTask'])) {
    $sql = "DELETE FROM task WHERE id=:task_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':task_id' => $_POST['xid']]);
    echo '<script>alert("Task deleted")</script>';
}
//code to Edit Task
if (isset($_POST['editTask'])) {
    $sql = "UPDATE task SET title=:ttl, description=:des WHERE id=:up_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':ttl' => $_POST['update_title'],
        ':des' => $_POST['update_description'],
        ':up_id' => $_POST['upid']
    ]);
    echo '<script>alert("Task Updated!")</script>';
}
//code to Edit Task Image
if (isset($_POST['editImage'])) {

    $Get_image_name = $_FILES['update_image']['name'];
    $image_Path = "upload/" . basename($Get_image_name);

    $sql = "UPDATE task SET image=:img WHERE id=:u_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':img' => $_FILES['update_image']['name'],
        ':u_id' => $_POST['up_Id']
    ]);

    if (move_uploaded_file($_FILES['update_image']['tmp_name'], $image_Path)) {
        echo '<script>alert("File Updated!")</script>';
    }
}
//code to Edit Task File
if (isset($_POST['editFile'])) {

    $Get_image_name = $_FILES['update_file']['name'];
    $image_Path = "upload/" . basename($Get_image_name);

    $sql = "UPDATE task SET file=:file WHERE id=:uid";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':file' => $_FILES['update_file']['name'],
        ':uid' => $_POST['upId']
    ]);

    if (move_uploaded_file($_FILES['update_file']['tmp_name'], $image_Path)) {
        echo '<script>alert("File Updated!")</script>';
    }
}
//code to add Quiz
if (isset($_POST['addQuestion'])) {
    $sql = "INSERT INTO quizzes (category, question, option1, option2, option3, option4, answer) VALUES (:cat, :quest, :opt1, :opt2, :opt3, :opt4, :ans)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':cat' => $_POST['category'],
        ':quest' => $_POST['question'],
        ':opt1' => $_POST['option1'],
        ':opt2' => $_POST['option2'],
        ':opt3' => $_POST['option3'],
        ':opt4' => $_POST['option4'],
        ':ans' => $_POST['answer']
    ]);
    echo '<script>alert("Quiz Added!")</script>';
}
//code for Edit Quiz
if (isset($_POST['editQuest'])) {
    $sql = "UPDATE quizzes SET category=:category, question=:question, option1=:opt1, option2=:opt2, option3=:opt3, option4=:opt4, answer=:ans WHERE qid=:update_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':category' => $_POST['update_category'],
        ':question' => $_POST['update_question'],
        ':opt1' => $_POST['update_opt1'],
        ':opt2' => $_POST['update_opt2'],
        ':opt3' => $_POST['update_opt3'],
        ':opt4' => $_POST['update_opt4'],
        ':ans' => $_POST['update_answer'],
        ':update_id' => $_POST['update_id']
    ]);
    echo '<script>alert("Quiz Updated")</script>';
}
//code to add Admin
if (isset($_POST['addAdmin'])) {
    $sql = "INSERT INTO users (name, email, password, acct_type) VALUES (:name, :email, :pword, 'Admin')";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':pword' => $_POST['password']
    ]);
    echo '<script>alert("Admin Added!")</script>';
}

//code to delete Admin/User
if (isset($_POST['delUser'])) {
    $sql = "DELETE FROM users WHERE ID=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $_POST['xID']]);
    echo '<script>alert("1 record deleted")</script>';
}

// code to edit admin
if (isset($_POST['editAdmin'])) {
    $sql = "UPDATE users SET name=:name, email=:email, password=:pword WHERE ID=:update_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['update_name'],
        ':email' => $_POST['update_email'],
        ':pword' => $_POST['update_password'],
        ':update_id' => $_POST['uid']
    ]);
    header("location: admin.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wizely | Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php if ($login_access == "Admin") { ?>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background: #35424a;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <h1 style="color:#e8491d; font-weight:bolder">WIZELY | </h1>
                <span class="navbar-text text-white" style="font-size: 20px;">
                    Admin, <?php echo $login_user; ?>
                </span>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-outline-danger" href="logout.php" role="button">Log-out</a>
            </form>
            </div>
        </nav>
        <div class="card">
            <div class="card-body">
                <h3>WIZELY Learning Management System</h3>
            </div>
            <div class="row">
                <div class="col-2">
                    <!-- Menu List -->
                    <div class="list-group" id="list-tab" role="tablist">
                        <a href="#" class="fa fa-bars"></a>
                        <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#dashboard" role="tab" aria-controls="home">Dashboard</a>
                        <br>
                        <a>
                            <h4 style="padding-left: 12px;">Added HTML LESSONS</h4>
                        </a>
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
                        <br>
                        <a>
                            <h4 style="padding-left: 12px;">Added CSS LESSONS</h4>
                        </a>
                        <?php
                        $sql = "SELECT * FROM lessons WHERE Category='CSS Lesson'";
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
                        <a><button type="button" class="btn btn-outline-dark btn-lg w-100" data-toggle="modal" data-target="#addLesson">+ Add Lesson</button></a>
                        <br>
                        <a class="list-group-item list-group-item-action" id="list-tasks-list" data-toggle="list" href="#tasks" role="tab" aria-controls="settings">Tasks</a>
                        <br>
                        <a>
                            <h4 style="padding-left: 12px;">Quizzes</h4>
                        </a>
                        <a class="list-group-item list-group-item-action" id="list-htmlquiz-list" data-toggle="list" href="#htmlquizzes" role="tab" aria-controls="settings">HTML Quiz</a>
                        <a class="list-group-item list-group-item-action" id="list-cssquiz-list" data-toggle="list" href="#cssquizzes" role="tab" aria-controls="settings">CSS Quiz</a>
                        <a class="list-group-item list-group-item-action" id="list-records-list" data-toggle="list" href="#records" role="tab" aria-controls="settings">Quiz Records</a>
                        <a><span><button type="button" class="btn btn-outline-dark btn-lg w-100" data-toggle="modal" data-target="#addQuizModal">+ Quiz Item</button></span></a>
                        <br />
                        <br>
                        <a class="list-group-item list-group-item-action" id="list-admins-list" data-toggle="list" href="#admins" role="tab" aria-controls="profile">Manage Admins</a>
                        <a class="list-group-item list-group-item-action" id="list-users-list" data-toggle="list" href="#users" role="tab" aria-controls="profile">Manage Users</a>
                    </div>
                </div>

                <!-- Number of Admins and Users -->
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="list-dash-list">
                            <div class="text-xs font-weight-bold text-info text-uppercase pt-2 mb-2">Total Registered Admins:</div>
                            <?php

                            $sql = "SELECT ID FROM users WHERE acct_type='Admin'";
                            $stmt = $conn->query($sql);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $count = $stmt->rowCount();
                            echo '<h4 style="color:#e8491d">' . $count . '</h4>';
                            ?>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-3">Total Registered Users:</div>
                            <?php

                            $sql = "SELECT ID FROM users WHERE acct_type='User'";
                            $stmt = $conn->query($sql);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $count = $stmt->rowCount();
                            echo '<h4 style="color:#e8491d">' . $count . '</h4>';
                            ?>
                        </div>
                        <!--Lessons Content -->
                        <?php
                        $sql = "SELECT * FROM lessons";
                        $stmt = $conn->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <?php
                            $id = $row['lessonName'];
                            $t_id = str_replace(" ", "", $id); //id for lessons on tab-panel
                            ?>

                            <div class="tab-pane fade" id="<?php echo $t_id ?>" role="tabpanel" aria-labelledby="list-lessons-list">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <h3><?php echo $row['lessonName']; ?>

                                        </h3>
                                    </div>
                                    <div class="form-group">
                                        <label for="category" class="control-label">Category:</label>
                                        <input type="text" name="category" class="form-control w-50" value="<?php echo $row['Category']; ?>" disabled>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h4>Main Topic:</h4>
                                        <input type="text" name="title1" class="form-control w-50" value="<?php echo $row['title1']; ?>" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description:</label>
                                        <textarea class="form-control w-50" name="desc1" id="exampleFormControlTextarea1" rows="3"><?php echo $row['description1']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="info" class="control-label">Additional Info:</label>
                                        <textarea class="form-control w-50" name="info1" id="exampleFormControlTextarea1" rows="3"><?php echo $row['info1']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example" class="control-label">Example:</label>
                                        <textarea class="form-control w-50" name="example1" id="exampleFormControlTextarea1" rows="3"><?php echo $row['example1']; ?></textarea>
                                    </div>
                                    <hr width="50%" align="left">
                                    <div class="form-group">
                                        <h4>Sub Topic:</h4>
                                        <input type="text" name="title2" class="form-control w-50" value="<?php echo $row['title2']; ?>">
                                    </div>
                                    <label for="description" class="control-label">Description:</label>
                                    <div class="form-group">
                                        <textarea class="form-control w-50" name="desc2" id="exampleFormControlTextarea1" rows="3"><?php echo $row['description2']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="info" class="control-label">Additional Info:</label>
                                        <textarea class="form-control w-50" name="info2" id="exampleFormControlTextarea1" rows="3"><?php echo $row['info2']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example" class="control-label">Example:</label>
                                        <textarea class="form-control w-50" name="example2" id="exampleFormControlTextarea1" rows="3"><?php echo $row['example2']; ?></textarea>
                                    </div>
                                    <hr width="50%" align="left">
                                    <div class="form-group">
                                        <h4>Sub Topic:</h4>
                                        <input type="text" name="title3" class="form-control w-50" value="<?php echo $row['title3']; ?>">
                                    </div>
                                    <label for="description" class="control-label">Description:</label>
                                    <div class="form-group">
                                        <textarea class="form-control w-50" name="desc3" id="exampleFormControlTextarea1" rows="3"><?php echo $row['description3']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="info" class="control-label">Additional Info:</label>
                                        <textarea class="form-control w-50" name="info3" id="exampleFormControlTextarea1" rows="3"><?php echo $row['info3']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example" class="control-label">Example:</label>
                                        <textarea class="form-control w-50" name="example3" id="exampleFormControlTextarea1" rows="3"><?php echo $row['example3']; ?></textarea>
                                    </div>
                                    <hr width="50%" align="left">
                                    <div class="form-group">
                                        <h4>Sub Topic:</h4>
                                        <input type="text" name="title4" class="form-control w-50" value="<?php echo $row['title4']; ?>">
                                    </div>
                                    <label for="description" class="control-label">Description:</label>
                                    <div class="form-group">
                                        <textarea class="form-control w-50" name="desc4" id="exampleFormControlTextarea1" rows="3"><?php echo $row['description4']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label">Additional Info:</label>
                                        <textarea class="form-control w-50" name="info4" id="exampleFormControlTextarea1" rows="3"><?php echo $row['info4']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example" class="control-label">Example:</label>
                                        <textarea class="form-control w-50" name="example4" id="exampleFormControlTextarea1" rows="3"><?php echo $row['example4']; ?></textarea>
                                    </div>
                                    <hr width="50%" align="left">
                                    <div class="form-group">
                                        <h4>Sub Topic:</h4>
                                        <input type="text" name="title5" class="form-control w-50" value="<?php echo $row['title5']; ?>">
                                    </div>
                                    <label for="description" class="control-label">Description:</label>
                                    <div class="form-group">
                                        <textarea class="form-control w-50" name="desc5" id="exampleFormControlTextarea1" rows="3"><?php echo $row['description5']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label">Additional Info:</label>
                                        <textarea class="form-control w-50" name="info5" id="exampleFormControlTextarea1" rows="3"><?php echo $row['info5']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example" class="control-label">Example:</label>
                                        <textarea class="form-control w-50" name="example5" id="exampleFormControlTextarea1" rows="3"><?php echo $row['example5']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="update_Id" id="update" class="form-control" value="<?php echo $row['lessonID'] ?>">
                                        <button type="submit" class="btn btn-outline-primary w-50" name="save_data"><i class="fa fa-check"></i></button>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>


                        <!-- TASKS -->
                        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="list-tasks-list">
                            <div class="card-header">
                                <h6>TASKS
                                    <span><button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#addTaskModal"><i class="fa fa-plus">Add Task</i></button></button></span>
                                </h6>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Sample Output</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM task ORDER BY title ASC ";
                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><a href="#" id="pop">
                                                    <?php echo '<img src="upload/' . $row['image'] . '"<br> <br>' ?>
                                                </a>
                                                <?php
                                                if (!empty($row['file'])) { ?>
                                                    <?php $row['file'];
                                                    echo '<a href="upload/' . $row['file'] . '">' ?><i class="fa fa-folder" aria-hidden="true">
                                                        Download File</i></a>
                                                    <br>
                                                    <a href="#" data-toggle="modal" data-target="#editFile" onclick="getFile(<?php echo $row['id'] ?>,'<?php echo $row['file'] ?>');"><i class="fa fa-file-text-o" aria-hidden="true"></i> Edit File</a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editImage" onclick="getImage(<?php echo $row['id'] ?>,'<?php echo $row['image'] ?>');"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editTask" onclick="getTask(<?php echo $row['id'] ?>,'<?php echo $row['title'] ?>','<?php echo $row['description'] ?>');"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteTask" onclick="deletexid(<?php echo $row['id'] ?>);"><i class="fa fa-trash"></i></button></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- HTML QUIZ -->
                        <div class="tab-pane fade" id="htmlquizzes" role="tabpanel" aria-labelledby="list-htmlquiz-list">
                            <div class="card-header">
                                <h6>HTML QUIZ</h6>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Questions</th>
                                        <th>Options</th>
                                        <th>Answers</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM quizzes WHERE category='HTML Quiz'";

                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['question']; ?></td>
                                            <td>
                                                <ol type="a" style="padding-left:0;">
                                                    <li><?php echo $row['option1']; ?></li>
                                                    <li><?php echo $row['option2']; ?></li>
                                                    <li><?php echo $row['option3']; ?></li>
                                                    <li><?php echo $row['option4']; ?></li>
                                                </ol>

                                            </td>
                                            <td><?php echo $row['answer']; ?></td>
                                            <td><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editQuest" onclick="getQuest(<?php echo $row['qid'] ?>,'<?php echo $row['category'] ?>',
                    '<?php echo $row['question'] ?>','<?php echo $row['option1'] ?>','<?php echo $row['option2'] ?>','<?php echo $row['option3'] ?>','<?php echo $row['option4'] ?>','<?php echo $row['answer'] ?>');"><i class="fa fa-edit"></i></button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- CSS QUIZ -->
                        <div class="tab-pane fade" id="cssquizzes" role="tabpanel" aria-labelledby="list-cssquiz-list">
                            <div class="card-header">
                                <h6>CSS QUIZ</h6>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Questions</th>
                                        <th>Options</th>
                                        <th>Answers</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM quizzes WHERE category='CSS Quiz'";

                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['question']; ?></td>
                                            <td>
                                                <ol type="a" style="padding-left:0;">
                                                    <li><?php echo $row['option1']; ?></li>
                                                    <li><?php echo $row['option2']; ?></li>
                                                    <li><?php echo $row['option3']; ?></li>
                                                    <li><?php echo $row['option4']; ?></li>
                                                </ol>

                                            </td>
                                            <td><?php echo $row['answer']; ?></td>
                                            <td><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editQuest" onclick="getQuest(<?php echo $row['qid'] ?>,'<?php echo $row['category'] ?>',
                    '<?php echo $row['question'] ?>','<?php echo $row['option1'] ?>','<?php echo $row['option2'] ?>','<?php echo $row['option3'] ?>','<?php echo $row['option4'] ?>','<?php echo $row['answer'] ?>');"><i class="fa fa-edit"></i></button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- QUIZ RECORDS -->
                        <div class="tab-pane fade" id="records" role="tabpanel" aria-labelledby="list-records-list">
                            <div class="card-header">
                                <h6>QUIZ RESULTS</h6>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Quiz Category</th>
                                        <th>Name</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM quizrecords";

                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['userId']; ?></td>
                                            <td><?php echo $row['Category'] ?></td>
                                            <td><?php echo $row['Name'] ?></td>
                                            <td><?php echo $row['Score']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- List of Admins -->
                        <div class="tab-pane fade" id="admins" role="tabpanel" aria-labelledby="list-admins-list">
                            <div class="card-header">
                                <h6>List of Admins
                                    <span><button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus">Add an Admin</i></button></span>
                                </h6>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM users WHERE acct_type='Admin'";
                                    $stmt = $conn->query($sql);
                                    $count = $conn->query($sql);
                                    $rowcount = $count->rowCount();
                                    // echo $rowcount;
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['ID']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo str_repeat('*', strlen($row['password'])); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editModal" onclick="getUserDetails(<?php echo $row['ID'] ?>,'<?php echo $row['name'] ?>','<?php echo $row['email'] ?>',
                                '<?php echo $row['password'] ?>');"><i class="fa fa-edit"></i></button>


                                                <?php if ($rowcount > 3) { ?>
                                                    <?php if ($row['name'] != $login_user) { ?>
                                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delModalAd" onclick="deleteXID(<?php echo $row['ID'] ?>);"><i class="fa fa-trash"></i></button>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- List of Users -->
                        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="list-users-list">
                            <div class="card-header">
                                <h6>List of Users</h6>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM users WHERE acct_type='User'";
                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['ID']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo str_repeat('*', strlen($row['password'])); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delModal" onclick="deletexID(<?php echo $row['ID'] ?>);"><i class="fa fa-trash"></i></button>
                                            </td>
                                        <?php } ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Modal to Add HTML Lessons-->
        <div class="modal fade" id="addLesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Lesson</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username" class="control-label">Choose Category:</label>
                                <select name="category" id="" class="form-control">
                                    <option value="" readonly>-------Select-------</option>
                                    <option value="HTML Lesson">HTML Lesson</option>
                                    <option value="CSS Lesson">CSS Lesson</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="lessonName" class="form-control" placeholder="Lesson Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title1" class="form-control" placeholder="Main Title" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="desc1" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="info1" id="exampleFormControlTextarea1" rows="3" placeholder="Additional Information"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="example1" id="exampleFormControlTextarea1" rows="3" placeholder="Example"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title2" class="form-control" placeholder="Sub Topic">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="desc2" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="info2" id="exampleFormControlTextarea1" rows="3" placeholder="Additional Information"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="example2" id="exampleFormControlTextarea1" rows="3" placeholder="Example"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title3" class="form-control" placeholder="Sub Topic">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="desc3" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="info3" id="exampleFormControlTextarea1" rows="3" placeholder="Additional Information"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="example3" id="exampleFormControlTextarea1" rows="3" placeholder="Example"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title4" class="form-control" placeholder="Sub Topic">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="desc4" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="info4" id="exampleFormControlTextarea1" rows="3" placeholder="Additional Information"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="example4" id="exampleFormControlTextarea1" rows="3" placeholder="Example"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title5" class="form-control" placeholder="Sub Topic">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="desc5" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="info5" id="exampleFormControlTextarea1" rows="3" placeholder="Additional Information"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="example5" id="exampleFormControlTextarea1" rows="3" placeholder="Example"></textarea>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addLessons">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal to Add Task -->
        <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="add_title" class="form-control" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <input type="Text" name="add_description" class="form-control" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="add_image" id="image" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Add File</label>
                                <input type="file" name="add_file" id="file" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addTask">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal to Edit Task -->
        <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Task</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="update_title" class="form-control" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <input type="Text" name="update_description" class="form-control" placeholder="Description" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="editTask">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="upid" id="upId">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal to Edit Task Picture -->
        <div class="modal fade" id="editImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Image</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="update_image" id="image" class="form-control form-control-lg" placeholder="form-control-lg" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="editImage">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="up_Id" id="up_ID">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal to Edit Task File -->
        <div class="modal fade" id="editFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update File</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="update_file" id="file" class="form-control form-control-lg" placeholder="form-control-lg" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="editFile">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="upId" id="upID">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal for Delete Task-->
        <div class="modal fade" id="deleteTask" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <div class="text-m font-weight-bold text-danger text-uppercase pt-2 mb-2">
                                Are you sure you want to delete task?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="xid" id="delid">
                            <button type="submit" class="btn btn-primary" name="delTask">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal to Add Quiz -->
        <div class="modal fade" id="addQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <select name="category" class="form-control">
                                    <option value="">---Select---</option>
                                    <option value="HTML Quiz">HTML Quiz</option>
                                    <option value="CSS Quiz">CSS Quiz</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="question" class="form-control" placeholder="Question" required>
                            </div>
                            <div class="form-group">
                                <label for="username" class="control-label">Options:</label>
                                <input type="Text" name="option1" class="form-control" placeholder="Option 1" required>
                            </div>
                            <div class="form-group">
                                <input type="Text" name="option2" class="form-control" placeholder="Option 2" required>
                            </div>
                            <div class="form-group">
                                <input type="Text" name="option3" class="form-control" placeholder="Option 3" required>
                            </div>
                            <div class="form-group">
                                <input type="Text" name="option4" class="form-control" placeholder="Option 4" required>
                            </div>
                            <div class="form-group">
                                <input type="Text" name="answer" class="form-control" placeholder="Answer" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="addQuestion">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Modal to Edit Quiz-->
        <div class="modal fade" id="editQuest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Questions</h5>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control" name="update_category">
                                        <option value="HTML Quiz">HTML Quiz</option>
                                        <option value="CSS Quiz">CSS Quiz</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="question" class="control-label">Question:</label>
                                    <input type="text" name="update_question" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="options" class="control-label">Options:</label>
                                    <input type="text" name="update_opt1" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="update_opt2" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="update_opt3" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="update_opt4" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="answer" class="control-label">Answer:</label>
                                    <input type="text" name="update_answer" class="form-control" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="editQuest">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="hidden" name="update_id" id="up_id">
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
        <!--Modal to Add Admin-->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="addAdmin">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!--Modal for Edit Admin-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Admin Details</h5>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name:</label>
                                    <input type="text" name="update_name" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label">E-mail:</label>
                                    <input type="text" name="update_email" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password:</label>
                                    <input type="password" name="update_password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="editAdmin">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="hidden" name="uid" id="upid">
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
        <!--Modal for Delete ADMINS-->
        <div class="modal fade" id="delModalAd" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Record</h5>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <p>Are you sure to delete Admin?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="xID" id="delID">
                            <button type="submit" class="btn btn-danger" name="delUser">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal for Delete USERS-->
        <div class="modal fade" id="delModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Record</h5>
                    </div>
                    <form action="" method="POST" class="form-horizontal">
                        <div class="modal-body">
                            <p>Reason to delete user:</p>
                            <input type="checkbox" required> NO SUBMITTED QUIZ
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="xID" id="delId">
                            <button type="submit" class="btn btn-danger" name="delUser">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <footer>
            <div>
                <p><span>WIZELY</span> Web Design &copy; 2021</p>
            </div>
        </footer>
    <?php } else {
        echo '<div id="danger"><h1>' . "FOR ADMINS ONLY" . '</h1><a href="index.php" style="font-size:30px; color:white; text-decoration:underline">HOME</a></div>'; ?>
    <?php } ?>
</body>

</html>
<script src="bootstrap/jquery.js"></script>
<script src="bootstrap/bootstrap.js"></script>

<script>
    function deletexid(x) { //for delete tasks
        document.getElementById('delid').value = x;
    }

    function deleteXID(x) { //delete admins
        document.getElementById('delID').value = x;
    }

    function deletexID(x) { //delete users
        document.getElementById('delId').value = x;
    }

    function getQuest(id, category, question, opt1, opt2, opt3, opt4, ans) { //edit quizzes
        $('select[name="update_category"]').val(category);
        $('input[name="update_question"]').val(question);
        $('input[name="update_opt1"]').val(opt1);
        $('input[name="update_opt2"]').val(opt2);
        $('input[name="update_opt3"]').val(opt3);
        $('input[name="update_opt4"]').val(opt4);
        $('input[name="update_answer"]').val(ans);
        $('#up_id').val(id);
    }

    function getTask(id, ttl, desc) { //edit task details
        $('#upId').val(id);
        $('input[name="update_title"]').val(ttl);
        $('input[name="update_description"]').val(desc);

    }

    function getImage(id, img) { // edit task image
        $('#up_ID').val(id);
        $('input[name="update_image"]').val(img);
    }

    function getFile(id, file) { // edit task file
        $('#upID').val(id);
        $('input[name="update_file"]').val(file);
    }

    function getUserDetails(id, name, email, pwd) { //edit admin
        $('input[name="update_name"]').val(name);
        $('input[name="update_email"]').val(email);
        $('input[name="update_password"]').val(pwd);
        $('#upid').val(id);
    }
</script>