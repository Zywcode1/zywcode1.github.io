<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: admin.php");
    exit();
}

$servername = "mysql.sqlpub.com:3306"; // 数据库服务器
$username = "zywtest1"; // 数据库用户名
$password = "y2Xw2nwrhehplLUU"; // 数据库密码
$dbname = "zywtest1"; // 数据库名称


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 处理分类添加
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO categories (name) VALUES ('$category_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "新分类添加成功";
    } else {
        echo "添加分类失败: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>管理游戏和分类</title>
</head>
<body>

<h1>管理游戏和分类</h1>
<a href="index.php">返回游戏列表</a>

<!-- 添加游戏表单 -->
<form method="POST" action="add_game.php">
    <h2>添加新游戏</h2>
    <input type="text" name="name" placeholder="游戏名称" required>
    <textarea name="description" placeholder="游戏简介" required></textarea>
    <input type="text" name="link" placeholder="游戏链接" required>
    <select name="category" required>
        <?php
        $categories = $conn->query("SELECT * FROM categories");
        while ($row = $categories->fetch_assoc()) {
            echo '<option value="'. $row['name'] .'">'. $row['name'] .'</option>';
        }
        ?>
    </select>
    <button type="submit">添加游戏</button>
</form>

<!-- 管理分类 -->
<h2>管理分类</h2>
<form method="POST">
    <input type="text" name="category_name" placeholder="分类名称" required>
    <button type="submit">添加新分类</button>
</form>

<!-- 显示现有分类 -->
<h3>现有分类</h3>
<ul>
    <?php
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row['name'] . ' <a href="delete_category.php?id=' . $row['id'] . '">删除</a></li>';
        }
    } else {
        echo "没有分类可显示";
    }
    ?>
</ul>

</body>
</html>
