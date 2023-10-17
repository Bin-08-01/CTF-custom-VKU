<?php
session_start();
if (!isset($_SESSION['dir'])) {
    $_SESSION['dir'] = 'upload/' . session_id();
}

$dir = $_SESSION['dir'];

if (!file_exists($dir))
    mkdir($dir);

if (isset($_GET["debug"])) die(highlight_file(__FILE__));
if (isset($_FILES["file"])) {
    $message = '';
    $success = '';
    try {
        $filename = $_FILES["file"]["name"];
        $partfile = explode(".", $filename);
        $extension =  end($partfile);
        if (in_array($extension, ["php", "phtml", "phar", "php3", "php4", "php5"])) {
            $error = "Please don't upload something danger :<";
        }
        else {
            $error = "";
            $file = $dir . "/" . $filename;
            move_uploaded_file($_FILES["file"]["tmp_name"], $file);
            $success = 'Upload file successfully: <a href="./' . $file . '">📂 View file</a><br>';
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>📂 Storage Website</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>
    <h3 class="display-4 text-center" style="margin-top: 20px">Storage Website</h3>
    <h6 class="display-8 text-center">This website used to upload, storage and view your files.</h6>
    <h6 class="display-8 text-center">Please don't upload something danger :<</h6>

    <div class="container" style="margin-top: 100px;">
        <p><a href="./<?= $dir ?>/">📂 Your folder</a></p>


        <form method="post" enctype="multipart/form-data">
            <h3 style="margin: 20px 0;">Select file to upload:</h3>
            <div class="mb-3">
                <label for="file" class="form-label"></label>
                <input class="form-control" name="file" type="file" id="file">
            </div>
            <br />
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
        <p style="color:red"><?php if(isset($error)){echo $error;} ?></p>
        <p style="color:green"><?php if(isset($success)) echo $success; ?></p>
        <a href="?debug" style="margin-top: 100px;">View source</a>


    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>



</html>