<!DOCTYPE html>
<html>
<div class="content" align="center">
<head>
    <title>登陆</title>
    <meta charset="utf-8" />

        <div class="header">
            <h1>登录页面</h1>
        </div>

        <style>
            .box{
                width:240px;
                height:90px;
                background:#f0f0f0;
            }
        </style>
        </head>
<body>
<!-- 登录界面 login.php-->
<div class="box">
    <form action="logincheck.php" method="post">
        <table>
            <tr>
                <td align="right">用户名：</td>
                <td><input type="text" name="username" value="请输入用户名" maxLength="6"/></td>
            </tr>
            <tr>
                <td align="right">密 码：</td>
                <td><input type="password" name="userpwd" maxLength="6"/></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="登陆" /> </td>
                <td>还没有账号，<a href="register.php">注册</a></td>
            </tr>
        </table>
    </form>
    <div>
</body>
</div>
</html>