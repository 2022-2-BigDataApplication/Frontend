<?php
    include 'log_check.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="headerCSS.css">
</head>

<header>
    <h1>New Jelly</h1>
    <?php
        if($jb_login) {
    ?>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="p_MYPAGE.php">Mypage</a></span>
    </nav>
    <?php
        } else {
    ?>
    <nav>
      <span><a href="p_login.php">Login</a></span>
      <span><a href="p_join.php">Join</a></span>
    </nav>
    <?php } ?>    
</header>

<body>
    <div style="text-align: center; padding-top: 100px;">
        <p style="font-size: 40px; text-align: center; font-weight: bold;">Movie Recommender</p>
        <button type="button" onClick="location.href='p_searchResult.php'">SEARCH</button>
        <button type="button" onClick="location.href='p_exploreResult.php'">EXPLORE</button>   
    </div>

    <div class="genre">
        
    </div>

</body>
</html>