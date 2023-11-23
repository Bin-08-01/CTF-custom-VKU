<?php
include_once('../connect.php');
$flag = "VKU{insert_is_not_hard_for_me}";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST["query"];

    if (strpos(strtoupper($query), 'INSERT') === 0) {
        try {
            $prepare = $db->prepare($query);
            if ($prepare) {
                $prepare->execute();
                $successMessage = "Câu truy vấn đã được thực hiện thành công!";
            } else {
                $error = "Không hợp lệ";
            }
        } catch (Exception $e) {
            $error = "Không hợp lệ";
        }
    } else {
        $error = "Câu truy vấn không hợp lệ. Chỉ chấp nhận câu truy vấn INSERT.";
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
    <h1>Challenge 4</h1>
    <p><b>Mô tả thử thách: </b>Hãy lưu thông tin của bạn vào Cơ sở dữ liệu của chúng tôi (Lưu ý ID là Key nên bạn phải chọn một giá trị lớn)</p>

    <div id="flagDiv">
        <p>Hãy nhập flag ở đây để qua thử thách tiếp theo</p>
        <form action="checkFlag.php" method="post" id="formFlag">
            <label for="flag">Flag:</label>
            <input type="text" id="flag" name="flag" required>
            <input type="text" id="idChall" name="idChall" hidden value="4">
            <button type="submit">Gửi</button>
        </form>
    </div>

    <form action="challenge4.php" method="post" id="formQuery">
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
    <?php elseif (isset($successMessage)) : ?>
        <p class="result success"><?= $successMessage ?></p>
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
                            window.location.href = "challenge5.php";
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