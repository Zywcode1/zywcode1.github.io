<?php
$servername = "mysql.sqlpub.com:3306"; // 数据库服务器
$username = "zywtest1"; // 数据库用户名
$password = "y2Xw2nwrhehplLUU"; // 数据库密码
$dbname = "zywtest1"; // 数据库名称

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $link = $_POST['link'];

    $sql = "INSERT INTO games (name, description, category, link) VALUES ('$name', '$description', '$category', '$link')";
    
    if ($conn->query($sql) === TRUE) {
        echo "新游戏添加成功";
    } else {
        echo "添加游戏失败: " . $conn->error;
    }
}

$conn->close();
header("Location: manage.php");
exit();
