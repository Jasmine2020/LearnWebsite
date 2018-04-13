<?php
//active.php
 $conn = mysqli_connect("localhost","root","root");
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


$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();
$query = mysqli_query($conn ,"select usernmae,token-time from userdb where status='0' and token='$verify'");
$row = mysqli_fetch_array($query);
if($row)
{
    if($nowtime>$row['token_exptime'])
    { 
        $msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.';
    }
    else
    {
        mysqli_query($conn,"update userdb set status=1 where user_id=".$row['user_id']);
        if(mysqli_affected_rows($conn)!=1) die(0);
        $msg = '激活成功';
    }
}
else
{
    $msg = 'error.';
}
echo $msg;