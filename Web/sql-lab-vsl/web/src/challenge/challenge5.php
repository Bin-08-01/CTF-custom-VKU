<?php
include_once('../connect.php');

$flag = "VKU{bing_chi_ling_is_so_cute}";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST["query"];

    if (strpos(strtoupper($query), 'UPDATE') !== 0) {
        $error = "Không hợp lệ";
    } else {
        try {
            $prepare = $db->prepare($query);
            if ($prepare) {
                $executeResult = $prepare->execute();
                $query = "SELECT * FROM users WHERE name = 'John Cena' and id = 73";
                $prepare = $db->prepare($query);
                $prepare->execute();
                $result = $prepare->get_result();
                if ($result->num_rows > 0) {
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $msg = $flag;
                } else {
                    $error = "John Cena: Tôi vẫn thấy tên mình bị saiiiii :<";
                }
            } else {
                $error = "Không hợp lệ";
            }
        } catch (Exception $e) {
            $error = "Không hợp lệ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Lab - Challenge 5</title>
    <link rel="stylesheet" href="./../assets/css/style-chall.css">

</head>

<body>
    <h1>Challenge 5</h1>
    <p><b>Mô tả thử thách: </b>Tôi là John Cena, tôi phát hiện tên của tôi trong Cơ sở dữ liệu bị sai. Hãy giúp tôi sửa lại tên cho đúng.</p>
    <p>Thông tin của John Sena hiện tại là:
    <ul>
        <li>ID: 73</li>
        <li>Tên: SBTC Sena</li>
        <li>Tuổi: 42</li>
        <li>Địa chỉ: Mỹ</li>
    </ul>
    </p>
    <div id="flagDiv">
        <p>Hãy nhập flag ở đây để qua thử thách tiếp theo</p>
        <form action="checkFlag.php" method="post" id="formFlag">
            <label for="flag">Flag:</label>
            <input type="text" id="flag" name="flag" required>
            <input type="text" id="idChall" name="idChall" hidden value="5">
            <button type="submit">Gửi</button>
        </form>
    </div>

    <form action="challenge5.php" method="post" id="formQuery">
        <label for="query">Nhập câu truy vấn:</label>
        <textarea id="query" name="query" rows="4" cols="50" required></textarea>
        <br>
        <button type="submit">Gửi truy vấn</button>
    </form>

    <?php if (isset($query)) : ?>
        <p class="result">Câu truy vấn của bạn là: <b><?= $query ?></b></p>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
        <p class="result error"><?= $error ?></p>
    <?php elseif (isset($msg)) : ?>
        <p class="result">Flag của bạn là: <b><?= $flag ?></b></p>
    <?php elseif (isset($data)) : ?>
        <div class="result">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tuổi</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['age'] ?></td>
                            <td><?= $row['address'] ?></td>
                        </tr>
                        <?php break; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <script src="./../assets/js/ajax.js"></script>
    <script>
        $(document).ready(function() {
            $("#formFlag").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "checkFlag.php",
                    data: formData,
                    success: function(response) {
                        if (response == true) {
                            alert("Flag chính xác");
                            window.location.href = "challenge6.php";
                        } else {
                            alert("Sai rồi");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>