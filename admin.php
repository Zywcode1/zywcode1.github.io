<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_user = "admin";
    $admin_pass = "123456";
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['loggedin'] = true;
        header("Location: manage.php");
        exit();
    } else {
        $login_error = "用户名或密码错误";
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
</head>
<body>

<h2>管理员登录</h2>
<form method="POST">
    <input type="text" name="username" placeholder="用户名" required>
    <input type="password" name="password" placeholder="密码" required>
    <button type="submit">登录</button>
</form>
<?php if (isset($login_error)) echo '<p>' . $login_error . '</p>'; ?>

</body>
</html>
