<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        include "db.php";
        $sql = "SELECT username FROM users WHERE username=?";
        $sth = $database->prepare($sql);
        $sth->bind_param('s', $_POST['username']);
        $sth->execute();
        $sth->store_result();
        if ($sth->num_rows() > 0) {
            $message = "Tên đăng nhập đã tồn tại";
        } else {
            $sql = "INSERT INTO users(username, password, email) VALUES (?, MD5(?), ?)";
            $sth = $database->prepare($sql);
            $sth->bind_param('sss', $_POST['username'], $_POST['password'], $_POST['email']);
            $sth->execute();
            $message = "Đăng ký thành công!";
        }
    } catch (mysqli_sql_exception $e) {
        $message = $e->getMessage();
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/style.css">
    <title>Đăng ký</title>
</head>
<body>
    <br/>
  <br/>
  <h2 style="text-align: center;">Đăng ký</h2>
  <form class="form-login" method="post" onsubmit="customSubmit(this)">
    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <span>
        <?php if (isset($message)) echo $message;?>
      </span>
      <button type="submit">Submit</button>
      <p style="left: 200px;"><a href="index.php">Đăng nhập</a>&emsp;</p>
    </div>
  </form>
</body>
</html>