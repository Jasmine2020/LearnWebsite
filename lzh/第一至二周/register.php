<!DOCTYPE html>
<html>
<div align="center">
    <head>
        <title>注册</title>
        <meta charset="utf-8" />
        <div class="header">
            <h1>注册界面</h1>
        </div>
        <style>
            .box{
                width:270px;
                height:140px;
                background:#f0f0f0;
            }
        </style>
    </head>
    <body>
    <div class="box">
        <form action="regcheck.php" method="post">
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
                    <td align="right">确认密码：</td>
                    <td><input type="password" name="confirm" maxLength="6"/></td>
                </tr>
                <tr>
                    <td align="right">邮箱：</td>
                    <td><input type="text" name="email" value="请输入正确的邮箱地址" maxLength="20"/></td>
                </tr>
                <tr>
                    <td colspa="2" align="right"><input type="Submit" name="Submit" value="注册"/></td>
                    <td>已有账号，<a href="login.php">登陆</a></td>
                </tr>
            </table>
        </form>
    </div>
    </body>
</div>
</html>