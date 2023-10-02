<?php
/* Directory tree of source code:
.
├── download.php
├── index.php
├── Model
│   ├── student.php
│   └── system.php
└── public
    └── css
        └── style.css
*/
foreach (glob("Model/*.php") as $filename) {
    include($filename);
}

if (isset($_GET['debug'])) {
    die(highlight_file('index.php'));
}

session_start();

if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: index.php");
}

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $data = file_get_contents($file['tmp_name']);
        $_SESSION['students'] = $data;
    }
}

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['gender'])) {
    $newStudent = new Student($_POST['id'], $_POST['name'], $_POST['gender']);

    $serializedData = serialize($newStudent);
    if (isset($_SESSION['students'])) {
        $_SESSION['students'] .= '|' . $serializedData; 
    }else{
        $_SESSION['students'] = $serializedData; 
    }
}

if (isset($_SESSION['students'])) {
    $data = $_SESSION['students'];
    $students = explode("|", $data);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý sinh viên</title>
        <link rel="stylesheet" href="./public/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>

        <!-- /?debug to view source code -->

        <form method="POST">
            <input type="hidden" name="reset" value="true">
            <button type="submit" class="btn btn-danger" style="float: right;">Reset</button>
        </form>

        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
            <h2 style="text-align: center;">Quản lý sinh viên</h2>
            <p>Cập nhập mới: Tính năng xuất và nhập file</p>
        </div>

        <hr>

        <div style="display: flex; justify-content: space-around; margin: 20px 0;">
            <div>
                <h4>Thêm sinh viên</h4>
                <form method="POST" style="">
                    <label for="name">Tên:</label>
                    <input type="text" name="name" class="form-control" id="name">
                    
                    <label for="id">ID Sinh viên:</label>
                    <input type="text" name="id" class="form-control" id="id">

                    <label for="gender">Giới tính:</label>
                    <input type="text" name="gender" class="form-control" id="gender">
                    <br>
                    <input type="submit" class="btn btn-success" value="Thêm sinh viên">
                </form>
            </div>
            <div>
                <h4><b>🌟 New: </b>Thêm sinh viên bằng cách tải lên file</h4>

                <form method="POST" enctype="multipart/form-data">
                <label for="file">Chọn file:</label><br>
                <input type="file" name="file" id="file"><br>
                <button type="submit" class="btn btn-primary" value="Upload" style="margin-top: 20px;">Tải lên!</button>
            </form>
            </div>
        </div>
        <h1>Danh sách sinh viên</h1>
        <hr>
        <?php if (isset($students)): ?>
        
            <h3>Thông tin sinh viên</h3>
            <form action="download.php" method="POST">
                <textarea name="data" id="data" hidden cols="30" rows="10"><?php echo $_SESSION['students']; ?></textarea>
                <button type="submit" class="btn btn-info">Xuất file</button>
            </form>
            <table>
                <tr>
                    <th>Tên</th>
                    <th>ID Sinh viên</th>
                    <th>Giới tính</th>
                </tr>
                <?php foreach ($students as $raw): ?>
                    <?php $student = unserialize($raw); ?>
                    <tr>
                        <td><?php echo $student->getName(); ?></td>
                        <td><?php echo $student->getId(); ?></td>
                        <td><?php echo $student->getGender(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Danh sách sinh viên rỗng, hãy thêm mới bằng 1 trong 2 cách được đề xuất ở trên</p>
        <?php endif; ?>
        
        <br><br><br>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>