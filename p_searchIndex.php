<?php
include('dbconn.php');
include 'log_check.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="search.css">
</head>

<body>
    <!--상단바-->
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

    <br><br>
    <!--검색창-->
    <div class="text">
        <br><br><br>
        <div class="filter">
        <br><br><br>
        <form action="p_searchResult.php" method="POST">
            <h2>Movie Recommender</h2>
            <br><br><br>
            <div class="filtering">
                <input type="text" name="search_key" placeholder="Enter What You Like">
                <button>Submit</button>
            </div>
        </form>
    </div>
    </div>
    <hr>        
</body>