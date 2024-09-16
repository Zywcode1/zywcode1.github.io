<?php
$servername = "mysql.sqlpub.com:3306"; // 数据库服务器
$username = "zywtest1"; // 数据库用户名
$password = "y2Xw2nwrhehplLUU"; // 数据库密码
$dbname = "zywtest1"; // 数据库名称

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$game_id = intval($_GET['id']);
$sql = "SELECT * FROM games WHERE id = $game_id";
$result = $conn->query($sql);
$game = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title><?php echo $game['name']; ?></title>
</head>
<body>

<h1><?php echo $game['name']; ?></h1>
<div>
    <iframe src="<?php echo $game['link']; ?>" width="600" height="400"></iframe>
</div>
<a href="index.php">返回游戏列表</a>

</body>
</html>
