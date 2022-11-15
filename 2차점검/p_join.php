<?php
    session_start();
    include('dbconn.php');
?>

<?php
    $userId = $_POST['userId'];
    $password = $_POST['pwd'];
    $userName = $_POST['userName'];
    $userIntro = $_POST['userIntro'];
    $password_confirm = $_POST['pwd_confirm'];
    if (!is_null($userId)){
        $id_sql = "SELECT userID from users where userId='$userId'";
        $id_resource = mysqli_query($connect, $id_sql);
        while ($id_row = mysqli_fetch_row($id_resource)){
            $userId_e = $id_row['userId'];
        }
        if ($userId == $userId_e){
            $wu = 1;
        }
        elseif ($password != $password_confirm) {
            $wp = 1;
        }
        else {
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
            $user_add_sql = "INSERT into users (userId, pwd, userName, introduction) VALUES ($userId, $password, $userName, $userIntro)";
            mysqli_query($connect, $user_add_sql);
            header('Location: p_login.php');
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="headerCSS.css">
</head>
<header>
    <h1>New Jelly</h1>
    <nav>
      <span><a href="p_login.php">Login</a></span>
      <span><a href="p_join.php">Join</a></span>
    </nav>
</header>
  <body>
  <main>
    <h2> Join us! </h2>
    <div>
      <table>
      <form action="p_join.php" method = "post">
        <tr>
          <td>ID</td>
          <td><input type="text" name="ID" placeholder="Email Address"></td>
        </tr>

        <tr><td></td><td></td><td></td></tr>

        <tr>
          <td>Password</td>
          <td><input type="text" name="PW" placeholder="password"></td>
          <td></td>
        </tr>

        <tr>
          <td>Check PW</td>
          <td><input type="text" name="PW_check" placeholder="check password"></td>
          <td></td>
        </tr>

        <tr><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td></tr>

        <tr>
          <td>NickName</td>
          <td><input type="text" name="name" placeholder="nickname"></td>
          <td></td>
        </tr>

        <tr>
          <td>Introduction</td>
          <td><input type="text" name="intro" placeholder="no more than 300byte"></td>
          <td></td>
        </tr>
      </table>
        <br>

        <p><input type="submit" name="submit" size="50" value="Done" style="height:30px; width:50px; margin: auto; display: block;"/></p>
        <?php
            if ($wu == 1){
                echo "<p> Duplicate ID </p>";
            }
            if ($wp == 1){
                echo "<p> Check your PW typing </p>";
            }
        ?>
      </form>       
    </div>
  </main>
  <?php mysqli_close($con); ?>
</body>
</html>