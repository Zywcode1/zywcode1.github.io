<?php
$servername = "mysql.sqlpub.com:3306"; // 数据库服务器
$username = "zywtest1"; // 数据库用户名
$password = "y2Xw2nwrhehplLUU"; // 数据库密码
$dbname = "zywtest1"; // 数据库名称

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT * FROM games";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>小游戏列表</title>
    <style>
        /* 基本样式 */
        body { font-family: Arial, sans-serif; display: flex; }
        .sidebar { width: 200px; }
        .content { flex-grow: 1; display: flex; flex-wrap: wrap; }
        .card { border: 1px solid #ccc; margin: 10px; padding: 10px; width: 200px; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); }
        .card a { text-decoration: none; color: black; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>游戏分类</h2>
    <ul>
        <li><a href="#">动作</a></li>
        <li><a href="#">冒险</a></li>
        <li><a href="#">益智</a></li>
        <li><a href="#">体育</a></li>
        <li><a href="#">其他</a></li>
    </ul>
</div>

<div class="content">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<a href="game.php?id=' . $row['id'] . '">玩游戏</a>';
            echo '</div>';
        }
    } else {
        echo "没有游戏可显示";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
