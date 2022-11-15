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
<header>
    <h1>New Jelly</h1>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="mypage.html">Mypage</a></span>
    </nav>
</header>
<body>
    <div id="filter">
        <form action="p_exploreResult.php" method="post">
            <h2>Filtering Option</h2>
            <br>
            
            RelesedDate:<input type="text" name="start_year" placeholder="start_year">
                        <input type="text" name="end_year" placeholder="end_year">
                        <br><br>
                            
            Genre : <input type="checkbox" name="genre[]" value="21">All
                    <input type="checkbox" name="genre[]" value="16">Animation
                    <input type="checkbox" name="genre[]" value="12">Adventure
                    <input type="checkbox" name="genre[]" value="10749">Romance
                    <input type="checkbox" name="genre[]" value="35">Comedy
                    <input type="checkbox" name="genre[]" value="28">Action
                    <input type="checkbox" name="genre[]" value="10751">Family
                    <input type="checkbox" name="genre[]" value="36">History
                    <input type="checkbox" name="genre[]" value="18">Drama
                    <input type="checkbox" name="genre[]" value="80">Crime
                    <input type="checkbox" name="genre[]" value="878">Science Fiction
                    <input type="checkbox" name="genre[]" value="14">Fantasy
                    <input type="checkbox" name="genre[]" value="10402">Music
                    <input type="checkbox" name="genre[]" value="27">Horror
                    <input type="checkbox" name="genre[]" value="99">Documentary
                    <input type="checkbox" name="genre[]" value="9648">Mystery
                    <input type="checkbox" name="genre[]" value="53">Thriller
                    <input type="checkbox" name="genre[]" value="37">Western
                    <input type="checkbox" name="genre[]" value="10770">TV Movie
                    <input type="checkbox" name="genre[]" value="10752">War
                    <input type="checkbox" name="genre[]" value="10769">Foreign
                    <br><br>

            Age Limitation:<input type="radio" name="age" value="all">All
                            <input type="radio" name="age" value="kids">Kids
                    <br><br>

            Viewing : <select name="view">
                <option value="0">Recently Released</option>
                <option value="1">Highly Scored</option>
                <option value="2">Most Commented</option>
            </select>   
                    <br><br><br>
            <button>SUBMIT</button>
            
        </form>
    </div>
</body>
</html>