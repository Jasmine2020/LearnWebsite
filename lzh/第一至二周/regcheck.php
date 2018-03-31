<?php
//注册处理界面 regcheck.php
 if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")
 {
    $user = $_POST["username"];
    $psw = $_POST["userpwd"];
    $psw_confirm = $_POST["confirm"];
    $email = $_POST["email"];
    $token = md5($user.$psw);
    echo $token;

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
                include("Smtp.class.php");
                $smtpserver = "smtp.qq.com";//SMTP服务器
                $smtpserverport =25;//SMTP服务器端口
                $smtpusermail = "271329508@qq.com";//SMTP服务器的用户邮箱
                $smtpemailto ="13051229898@163.com";//发送给谁(可以填写任何邮箱地址)
                $smtpuser = "271329508@qq.com";//SMTP服务器的用户帐号(即SMTP服务器的用户邮箱@前面的信息)
                $smtppass = "lzhlz980511";//SMTP服务器的用户密码
                $mailtitle = 'test';//邮件主题
                $mailcontent = "<h1>您成功发送了一条电子邮件</h1>";//邮件内容
                $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

                $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
                $smtp->debug = false;//是否显示发送的调试信息
                $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

                if($state==""){
                    echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
                    exit();
                }

                echo "<script>alert('注册成功！请查收邮件'); history.go(-1);</script>";
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