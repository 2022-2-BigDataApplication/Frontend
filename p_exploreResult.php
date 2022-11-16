
<?php
session_start();
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
    <div id="filter">
        <form action="p_exploreResult.php" method="post">
            <h2>Filtering Option</h2>
            <br>
            
            RelesedDate:<input type="text" name="start_year" placeholder="start_year" value="<?php echo $start_year; ?>">
                        <input type="text" name="end_year" placeholder="end_year" value="<?php echo $end_year; ?>">
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
                <option value="0" default>Recently Released</option>
                <option value="1">Most Commented</option>
                <option value="2">Highly Scored</option>
            </select>   
            <br><br><br>
            <center><button>SUBMIT</button></center>
            <br><br><br>
        </form>
        <hr>
    </div>
    <br><br><br>
    <br><br><br>
    <div>
        <?php

            /* 장르전체 */
            if($genre[0]=='21') {
                /*성인*/
                if($age=='all') {
                    /*최신순*/
                    if($view=='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        WHERE DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        ORDER BY openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num` FROM review as r
                        INNER JOIN movie_metadata as m on r.movieId = m.movieId
                        WHERE DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        GROUP BY m.movieId
                        order by review_num desc;";
                    } 
                    /*리뷰순*/
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
                    /*별점순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*리뷰순*/
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
                /*성인*/
                if($age=='all') {
                    /*최신순*/
                    if($view=='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        and (genreId in ($genre))
                        order by openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        
                        and (genreId in $genre)
                    
                        GROUP BY m.movieId

                        order by review_num desc;";
                    } 
                    /*리뷰순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))
                        
                        and (genreId in $genre)
                        
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
                        and (genreId in ($genre))
                        and adult=0
                        order by openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view=='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))

                        
                        and (genreId in $genre)
                        and adult=0
                        GROUP BY m.movieId
                        

                        order by review_num desc;";
                    } 
                    /*리뷰순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where DATE_FORMAT(openDt, '%Y') between CAST($start_year AS CHAR(4)) and CAST($end_year AS CHAR(4))

                        
                        and (genreId in $genre)
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
                $_Session['pathKey'] = $row[1];
                
                if ($count%4==0){
                    echo "<tr>";
                }
                ?> 
                
                <td><a href="movieSession.php"><img src=<?=$poster?> onerror = "this.style.display = 'none';"/></a></td>
                
                <?php
                if ($count%4==3){
                    echo "</tr>";
                }
                $count++;
            };
       ?></table>
    </div>
    <?php mysqli_close($connect);?>
</body>
</html>

