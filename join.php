<?php
    include('dbconn.php');

    $userId = $_POST['userId'];
    $password = $_POST['pwd'];
    $userName = $_POST['userName'];
    $userIntro = $_POST['userIntro'];
    $password_confirm = $_POST['pwd_confirm'];

    $id_check_sql = "SELECT userId from users where userId = '$userId';";
    $id_check_resource = mysqli_query($connect, $id_check_sql);
    $id_check = mysqli_fetch_row($id_check_resource);

    if(!is_null($id_check)) {
        echo("
            <script>
            window.alert('ID overlapped!')
            history.go(-1)
            </script>
        ");
    }
    elseif($password != $password_confirm){
        echo("
            <script>
            window.alert('Check PW input is not equal!')
            history.go(-1)
            </script>
        ");
    }
    else{
        $user_add_sql = "INSERT into users (userId, pwd, userName, introduction) VALUES ('$userId', '$password', '$userName', '$userIntro')";
        mysqli_query($connect, $user_add_sql);
        header('Location: p_login.php');
    }

mysqli_close($con); 
?>