<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="headerCSS.css">
</head>
<header>
<h1><a href="p_MAIN.php" style="color:white; text-decoration: none;">New Jelly</a></h1>
    <nav>
      <span><a href="p_login.php">Login</a></span>
      <span><a href="p_join.php">Join</a></span>
    </nav>
</header>
  <body>
  <main>
    <h2> Welcome! </h2>
    <div class="div-parent" style="margin-top: 30px">
    <div class="div-child">
      <form action="login.php" method = "POST">
      <table>
        <tr>
          <td>ID</td>
          <td><input type="text" name="ID" placeholder="typing your own ID"></td>
        </tr>

        <tr><td></td><td></td><td></td></tr>

        <tr>
          <td>Password</td>
          <td><input type="text" name="PW" placeholder="password"></td>
          <td></td>
        </tr>
        
        </table>
        <br>

        <p><input type="submit" name="submit" size="50" value="Done" style="height:30px; width:50px; margin: auto; display: block;"/></p>
      </form>
    </div>       
    </div>
  </main>
</body>
</html>