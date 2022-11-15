<?php
    include 'log_check.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="search.css">
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
    <div class="outer">
        <form action="search.php" method="GET">
            <h2>Movie Recommender</h2>
            <div class="searchbox">
                <input type="text" name="search_key" placeholder="Enter What You Like">
                <button type="submit" value="search">Search</button>
            </div>
        </form>
    </div>

    <div class="serchresult">
        <h3>Search Result</h3>
        <?php
            if(!$key){
                echo "Before Research";
            }
            else {
        ?>
            <!--제목 포함-->
            <div class="movieresult">
                <h4>Title</h4>
            </div>
            <!--배우 포함-->
            <div class="movieresult">
                <h4>Actor</h4>
            </div> 
            <!--감독 포함-->
            <div class="movieresult">
                <h4>Director</h4>
            </div>
            <div class="movieresult">
                <h4>Keyword</h4>
            </div>
        <?php } ?>
    </div>
</body>
