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
    <h1><a href="p_MAIN.php">New Jelly</a></h1>
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
        <table>
            <tr>
                <td>RelesedDate : </td>
                <td><input type="text" name="start_year" placeholder="start_year" value="1920">
                <input type="text" name="end_year" placeholder="end_year" value="2022">
                </td>
            </tr>    
                        <br><br>
                            
            <tr>
                <td>Genre : </td>
                <td>
                    <input type="radio" name="genre" value="21" checked>All
                    <input type="radio" name="genre" value="16">Animation
                    <input type="radio" name="genre" value="12">Adventure
                    <input type="radio" name="genre" value="10749">Romance
                    <input type="radio" name="genre" value="35">Comedy
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="radio" name="genre" value="28">Action
                    <input type="radio" name="genre" value="10751">Family
                    <input type="radio" name="genre" value="36">History
                    <input type="radio" name="genre" value="18">Drama
                    <input type="radio" name="genre" value="80">Crime
                </td>
            </tr>
            <tr>
                <td></td>
                <td>   
                    <input type="radio" name="genre" value="878">Science Fiction
                    <input type="radio" name="genre" value="14">Fantasy
                    <input type="radio" name="genre" value="10402">Music
                    <input type="radio" name="genre" value="27">Horror
                    <input type="radio" name="genre" value="99">Documentary
                </td>
            </tr>
            <tr>
                <td></td>
                <td> 
                    <input type="radio" name="genre" value="9648">Mystery
                    <input type="radio" name="genre" value="53">Thriller
                    <input type="radio" name="genre" value="37">Western
                    <input type="radio" name="genre" value="10770">TV Movie
                    <input type="radio" name="genre" value="10752">War
                </td>
            </tr>
            <tr>
                <td></td>
                <td> 
                    <input type="radio" name="genre" value="10769">Foreign
                </td>
            </tr>
                    <br><br>

            <tr>
                <td>Age Limitation : </td>
                <td><input type="radio" name="age" value="all" checked>All
                    <input type="radio" name="age" value="kids">Kids
                </td> 
            </tr>
                <br><br>
            <tr>
                <td>Viewing : </td>
                <td>
                    <select name="view">
                    <option value="0" default>Recently Released</option>
                    <option value="1">Most Commented</option>
                    <option value="2">Highly Scored</option>
                    </select>
                </td>
            </tr>
        </table>  
                    <br><br><br>

            <button>SUBMIT</button>
        </div> 
        </form>
    </div>
</body>
</html>
