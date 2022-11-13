<?php
session_start();
?>
<meta charset = "utf-8">
<?php
// ID가 입력되지 않았으면 -> ID를 입력하시오 - 메세지 출력
// PW가 입력되지 않았으면 -> PW를 입력하시오 - 메세지 출력
if (!$id)
{
    echo("
    <script>
    window.alert('Insert ID')
    history.go(-1)
    </script>
    ");
    exit;
}

if (!$pass)
{
    echo("
    <script>
    window.alert('Insert PW')
    history.go(-1)
    </script>
    ");
    exit;
}

include ("dbconn.php");

$sql = "select * from userId where id='$id'";
$result = mysql_query($sql, $connect);
$num_match = mysql_num_rows($result);

if(!$num_match){
    echo("
    <script>
    window.alert('This ID is not in our DB')
    history.go(-1)
    </script>
    ");
}
else{
    $row=mysql_fetch_array($result);
    $db_pass=$row[pass];

    if($pass!=$db_pass)
    {
        echo("
        <script>
        window.alert('Wrong PW')
        history.go(-1)
        </script>
        ");
        exit;
    }
    else
    {
        $userid=$row[userId];
        $username=$row[userName];
        $userIntro=$row[introduction];

        $_SESSION['userid']=$userid;
        $_SESSION['username']=$username;
        $_SESSION['userIntro']=$userIntro;

        echo("
        <script>
        location.href='MAIN.php';
        </script>
        ");
    }
}
?>