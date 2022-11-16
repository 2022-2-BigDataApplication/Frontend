<?php
session_start();

$id = $_POST['ID'];
$pass = $_POST['PW'];

    if (!$id) {
        echo("
        <script>
        window.alert('Insert ID')
        history.go(-1)
        </script>
        ");
        exit;
    }

    if (!$pass) {
        echo("
        <script>
        window.alert('Insert PW')
        history.go(-1)
        </script>
        ");
        exit;
    }

    include ("dbconn.php");

    $id_sql = "SELECT * from users where userId='$id'";
    $id_result = mysqli_query($connect, $id_sql);
    $id_num_match = mysqli_num_rows($id_result);

    if(!$id_num_match){
        echo("
        <script>
        window.alert('This ID is not in our DB')
        history.go(-1)
        </script>
        ");
    }
    else{
        $login_row=mysqli_fetch_array($id_result);
        $db_pass=$login_row['pwd'];

        if($pass != $db_pass)
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
            $userid = $login_row['userId'];

            $_SESSION['userId'] = $userid;

            echo("
            <script>
            location.href='p_MAIN.php';
            </script>
            ");
        }
    }
    mysqli_free_result($id_result);
    mysqli_close($connect); 
?>