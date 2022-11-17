<?php
include('log_check.php');
include('dbconn.php');

$start_year= $_POST['start_year'];
$end_year= $_POST['end_year'];
$genre= $_POST['genre']; 
$age= $_POST['age'];
$view= $_POST['view'];
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="search.css">
</head>

<body>
<header>
<h1><a href="p_MAIN.php" style="color:white; text-decoration: none;">New Jelly</a></h1>
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
    <div class="filter">
        <form action="p_exploreResult.php" method="post">
            <h2>Filtering Option</h2>
            <br>
        <div class="filtering">    
        <table>
            <tr>
                <td>RelesedDate : </td>
                <td><input type="text" name="start_year" placeholder="start_year" value="<?php echo $start_year; ?>">
                <input type="text" name="end_year" placeholder="end_year" value="<?php echo $end_year; ?>">
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
            <center><button>SUBMIT</button></center>
            <br><br><br>
        </div>
        </form>
    </div>
    <div class="result">
        <?php

            /* 장르전체 */
            if($genre=='21') {
                /*성인*/
                $view_mode = "";
                if($view==0){
                    $view_mode="Recently Released";
                }
                else if ($view==1) {
                    $view_mode="Most Commented";
                }
                else {
                    $view_mode="Highly Scored";
                }
                echo "<p class = \"explore_summary\">show All movies between $start_year ~ $end_year, for $age, in order of $view_mode</p>";

                if($age=='all') {
                    /*최신순*/
                    if($view=='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        WHERE DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        ORDER BY openDt desc;";
                    } 
                    /*리뷰순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num` FROM review as r
                        INNER JOIN movie_metadata as m on r.movieId = m.movieId
                        WHERE DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        GROUP BY m.movieId
                        order by review_num desc;";
                    } 
                    /*별점순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    }
                } 
                /*키즈*/
                else {
                    if($view=='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and adult=0
                        order by openDt desc;";
                    } 
                    /*리뷰순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*별점순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    }
                }
            } 
            /* 장르선택 */
            else {
                    if ($genre=='16'){
                        $genreNm="Animation";
                    }
                    else if ($genre=='12'){
                        $genreNm="Adventure";
                    }
                    else if ($genre=='10749'){
                        $genreNm="Romance";
                    }
                    else if ($genre=='35'){
                        $genreNm="Comedy";
                    }
                    else if ($genre=='28'){
                        $genreNm="Action";
                    }
                    else if ($genre=='10751'){
                        $genreNm="Family";
                    }
                    else if ($genre=='36'){
                        $genreNm="History";
                    }
                    else if ($genre=='18'){
                        $genreNm="Drama";
                    }
                    else if ($genre=='80'){
                        $genreNm="Crime";
                    }
                    else if ($genre=='878'){
                        $genreNm="Science Fiction";
                    }
                    else if ($genre=='14'){
                        $genreNm="Fantasy";
                    }
                    else if ($genre=='10402'){
                        $genreNm="Music";
                    }
                    else if ($genre=='27'){
                        $genreNm="Horror";
                    }
                    else if ($genre=='99'){
                        $genreNm="Documentary";
                    }
                    else if ($genre=='9648'){
                        $genreNm="Mystery";
                    }
                    else if ($genre=='53'){
                        $genreNm="Thriller";
                    }
                    else if ($genre=='37'){
                        $genreNm="Western";
                    }
                    else if ($genre=='10770'){
                        $genreNm="TV Movie";
                    }
                    else if ($genre=='10752'){
                        $genreNm="War";
                    }
                    else{
                        $genreNm="Foreign";
                    }
               
                    /*
                    $start_year= $_POST['start_year'];
                    $end_year= $_POST['end_year'];
                    $genre= $_POST['genre']; 
                    $age= $_POST['age'];
                    $view= $_POST['view'];
                    */

                    $view_mode = "";
                    if($view==0){
                        $view_mode="Recently Released";
                    }
                    else if ($view==1) {
                        $view_mode="Most Commented";
                    }
                    else {
                        $view_mode="Highly Scored";
                    }
                    echo "<p class = \"explore_summary\">show $genreNm movies between $start_year ~ $end_year, for $age, in order of $view_mode</p>";
                
                /*성인*/
                if($age=='all') {
                    /*최신순*/
                    if($view=='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and (genreId = $genre)
                        order by openDt desc;";
                    } 
                    /*리뷰순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        
                        and (genreId = $genre)
                    
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*별점순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        
                        and (genreId = $genre)
                        
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    }
                } 
                /*키즈*/
                else {
                    /*최신순*/
                    if($view=='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and (genreId = $genre)
                        and adult=0
                        order by openDt desc;";
                    } 
                    /*리뷰순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        
                        and (genreId = $genre)
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*별점순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        
                        and (genreId = $genre)
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    } 
                }

            }
        
            $res = mysqli_query($connect, $sql);

            ?>

            <table><?php
            $count=0;
            while($row = mysqli_fetch_row($res) and $count<20) {

                
                $poster = "http://image.tmdb.org/t/p/w185/$row[1]";
                $title5 = $row[0];
                
                if ($count%4==0){
                    echo "<tr>";
                }
                ?> 
                <td><img src=<?=$poster?> style="width:185px; height:265px;" onerror = "this.src='NoImage.png'; this.style='width:185px; height:265px;'"/>
                    <form action="movieSession.php" method="POST">
                    <input type="submit" name="pathKey" value ="<?=$title5 ?>" align = "middle" style="height:50px; width:185px;">
                    </form>
                </td>
                <?php
                if ($count%4==3){
                    echo "</tr>";
                }
                $count++;

            };
       ?></table>
    </div>
    <?php 
    mysqli_free_result($res);
    mysqli_close($connect);?>
</body>
</html>