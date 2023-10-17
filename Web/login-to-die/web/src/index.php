<?php 
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    try{
        include "db.php";
        $sql = "SELECT username FROM users WHERE username=? AND password=MD5(?)";
        $prepare = $database->prepare($sql);
        $prepare->bind_param('ss', $_POST["username"], $_POST["password"]);
        $prepare->execute();
        $prepare->store_result();
        $prepare->bind_result($result);

        if($prepare->num_rows > 0) {
            $prepare->fetch();
            $_SESSION["username"] = $result;
            // die($result);
            die(header("location: info.php"));
        }else{
            $message = "Wrong username or password, try again!";
        }
    } catch(mysqli_sql_exception $e){
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/style.css">
    <title>Auth</title>
</head>
<body>
    <h2 style="text-align: center;">Đăng nhập</h2>

    <form class="form-login" method="post" onsubmit="customSubmit(this)">
    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <span>
        <?php if (isset($message)) echo $message . "<br/>";?>
      </span>
      <button type="submit">Login</button>
      <p style="left: 200px;">Không có tài khoản? Hãy <a href="register.php">Đăng ký</a></p>
    </div>
  </form>
</body>
</html>