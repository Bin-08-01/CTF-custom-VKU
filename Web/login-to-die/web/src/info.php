<?php
    include "db.php";

    session_start();
if(isset($_SESSION["username"])){
    if($_SESSION['username'] == "admin"){

            try{
                $sql = "SELECT content FROM secret";
                $sth = $database->prepare($sql);
                $sth->execute();
                $sth->store_result();
                $sth->bind_result($result);
                if($sth->num_rows > 0) {
                    $sth->fetch();
                    $data = $result;
                }else{
                }

            } catch(mysqli_sql_exception $e){
                echo $e;
            }
        }
    }else{
        $data = "Bạn phải là admin mới được xem flag";
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./static/css/styles.css">
  <title>Trang cá nhân</title>
</head>

<body>        
  <br/>
  <br/>
  <h2 style="text-align: center;">Thông tin cá nhân</h2>
  <form class="form-login" method="post">
    <div class="container">
      
      <div style="text-align: center;">
        <p>
            Username: <?= $_SESSION["username"]?>
        </p>
        <?php 
            if(isset($data)){
                echo "<b>Chúc mừng bạn, cờ đây, lấy đi: ".$data."</b>";
            }
        ?>
      </div>
    </div>
  </form>
</body>

</html>
