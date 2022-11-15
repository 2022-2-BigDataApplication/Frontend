<?php
session_start();
include('log_check.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="headerCSS.css">
</head>

<header>
    <h1>New Jelly</h1>
    <?php
        if(isset($_SESSION['userId'])) {
    ?>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="Mypage.php">Mypage</a></span>
    </nav>
    <?php
        } else {
    ?>
    <nav>
      <span><a href="login.php">Login</a></span>
      <span><a href="join.php">Join</a></span>
    </nav>
    <?php } ?>    
</header>

<body>
    <div style=" text-align: center; padding-top: 100px;">
        <p style="font-size: 40px; text-align: center; font-weight: bold;">Movie Recommender</p>
        <button type="button" onClick="location.href='SEARCHRESULT.html'">SEARCH</button>
        <button type="button" onClick="location.href='EXPLORE.html'">EXPLORE</button>   
    </div>

    <div class="genre">
        
    </div>

</body>
</html>