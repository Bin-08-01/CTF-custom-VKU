<?php
include_once('../connect.php');
$flag = "VKU{LIKE_in_sql_is_so_easy}";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST["query"];

    if (strpos(strtoupper($query), 'SELECT') !== 0) {
        $error = "Không hợp lệ";
    } else {
        try {
            $prepare = $db->prepare($query);
            if ($prepare) {
                $prepare->execute();
                $result = $prepare->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($data as $row) {
                    if ($row['name'] == 'Sam Altman') {
                        $msg = "Flag: $flag";
                        break;
                    }
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
    <title>SQL Lab - Challenge 3</title>
    <link rel="stylesheet" href="./../assets/css/style-chall.css">

</head>

<body>
    <h1>Challenge 3</h1>
    <p><b>Mô tả thử thách: </b>Hãy lấy thông tin của người dùng mà tên có chứa cụm từ <b>tma</b></p>

    <div id="flagDiv">
        <p>Hãy nhập flag ở đây để qua thử thách tiếp theo</p>
        <form action="checkFlag.php" method="post" id="formFlag">
            <label for="flag">Flag:</label>
            <input type="text" id="flag" name="flag" required>
            <input type="text" id="idChall" name="idChall" hidden value="3">
            <button type="submit">Gửi</button>
        </form>
    </div>

    <form action="challenge3.php" method="post" id="formQuery">
        <label for="query">Nhập câu truy vấn:</label>
        <textarea id="query" name="query" rows="4" cols="50" required></textarea>
        <br>
        <button type="submit">Gửi truy vấn</button>
    </form>

    <?php if (isset($msg)) : ?>
        <p class="result"><b><?= $msg ?></b></p>
    <?php endif; ?>
    <?php if (isset($query)) : ?>
        <p class="result">Câu truy vấn của bạn là: <b><?= $query ?></b></p>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
        <p class="result error"><?= $error ?></p>

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
                            window.location.href = "challenge4.php";
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