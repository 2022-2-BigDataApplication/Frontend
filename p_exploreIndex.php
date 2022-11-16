<?php
include ('log_check.php');
include('dbconn.php');
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="search.css">
</head>

<body>
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
    <div class ="filter">
        <form action="p_exploreResult.php" method="post">
            <h2>Filtering Option</h2>
            <br>
        <div class="filtering">
            RelesedDate:<input type="text" name="start_year" placeholder="start_year" value='1920'>
                        <input type="text" name="end_year" placeholder="end_year" value='2022'>
                        <br><br>
                            
            Genre : <input type="checkbox" name="genre[]" value="21" checked>All
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

            Age Limitation:<input type="radio" name="age" value="all" checked>All
                            <input type="radio" name="age" value="kids">Kids
                    <br><br>

            Viewing : <select name="view">

                <option value="0">Recently Released</option>
                <option value="1">Most Commented</option>
                <option value="2">Highly Scored</option>
            </select>   
                    <br><br><br>

            <button>SUBMIT</button>
        </div> 
        </form>
    </div>
</body>
</html>
