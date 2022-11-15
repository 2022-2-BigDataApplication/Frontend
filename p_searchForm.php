<?php
session_start();
include('dbconn.php');
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="headerCSS.css">
        <style>
            * {margin: 0; padding: 0;}
            #wrap {
                width=650px;
                margin: 0 auto;
                overflow: hidden;
                padding-top: 10px;
            }

            div > article {
                float: left;
                margin-left: 10px;
                margin-bottom: 10px;
            }

            img {display: block;}
        </style>
</head>

<body>
<header>
    <h1>New Jelly</h1>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="mypage.html">Mypage</a></span>
    </nav>
</header>
    <div class="text">
        <br><br><br>
        <center>
        <form action="p_searchResult.php" method="POST">
            
            <h2>Movie Recommender</h2>
            <br>
        
            <input type="text" name="search_key" placeholder="Enter What You Like"><br><br>
            <button>Submit</button>

        </form>
    </center>
    </div>

    <br><br>

    <hr>

    <br>

</body>