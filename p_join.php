<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="headerCSS.css">
</head>
<header>
<h1><a href="p_MAIN.php">New Jelly</a></h1>
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
      <form action="join.php" method = "POST">
        <tr>
          <td>ID</td>
          <td><input type="text" name="userId" placeholder="ID" required></td>
        </tr>

        <tr><td></td><td></td><td></td></tr>

        <tr>
          <td>Password</td>
          <td><input type="text" name="pwd" placeholder="password" required></td>
          <td></td>
        </tr>

        <tr>
          <td>Check PW</td>
          <td><input type="text" name="pwd_confirm" placeholder="check password" required></td>
          <td></td>
        </tr>

        <tr><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td></tr>

        <tr>
          <td>NickName</td>
          <td><input type="text" name="userName" placeholder="nickname" required></td>
          <td></td>
        </tr>

        <tr>
          <td>Introduction</td>
          <td><input  type="text" name="userIntro" placeholder="no more than 300byte" required></td>
          <td></td>
        </tr>
      </table>
        <br>

        <p><input type="submit" name="submit" size="50" value="Done" style="height:30px; width:50px; margin: auto; display: block;"/></p>
        
      </form>       
    </div>
  </main>
</body>
</html>