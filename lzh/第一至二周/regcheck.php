<?php
//注册处理界面 regcheck.php
 if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
 {
    $user = $_POST["username"];
    $psw = $_POST["userpwd"];
    $psw_confirm = $_POST["confirm"];
    $email = $_POST["email"];
    if($user == "" || $psw == "" || $psw_confirm == ""||$email == "")
    {
        echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
    }
    else
    {
    if($psw == $psw_confirm)
    {
        //建立连接
        $conn = mysqli_connect("localhost","root","root"); //连接数据库,帐号密码为自己数据库的帐号密码
        //如果连接失败就返回上一次链接错误的错误代码
        if(mysqli_errno($conn))
        {
            echo mysqli_error($conn);
            exit;
        }
        else
        {
            echo "connect successful";
        }
        mysqli_select_db($conn,"userdb"); //选择数据库
        mysqli_set_charset($conn,'utf8'); //设定字符集
        $sql = "select username from user where username = '$user'"; //准备SQL语句，查询用户名
        $result = mysqli_query($conn,$sql); //执行SQL语句
        $num = mysqli_num_rows($result); //统计执行结果影响的行数

        if($num) //如果已经存在该用户
        {
            echo "<script>alert('用户名已存在'); history.go(-1);</script>";
        }
        else //不存在当前注册用户名称
        {
            //准备SQL语句插入用户数据
            $sql_insert = "insert into user(id,username,userpwd,email) values (null,'$user','$psw','$email')";
            //执行SQL语句
            $result = mysqli_query($conn,$sql_insert);
            if($result)
            {
                echo "<script>alert('注册成功！'); history.go(-1);</script>";
                mysqli_close($conn);
            }
            else
            {
                echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('密码不一致！'); history.go(-1);</script>";
    }
    }
 }
 else
 {
    echo "<script>alert('提交未成功！');</script>";
 }
?>