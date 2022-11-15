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
    <div>
        <?php

            $start_year= $_POST['start_year'];
            $end_year= $_POST['end_year'];
            $genre= $_POST['genre']; 
            $age= $_POST['age'];
            $view= $_POST['view'];

            /* 장르전체 */
            if($genre[0]='21') {
                /*성인*/
                if($age='all') {
                    /*최신순*/
                    if($view='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        order by openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
 
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*리뷰순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    }
                } 
                /*키즈*/
                else {
                    if($view='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        and adult=0
                        order by openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*리뷰순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
        
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    }
                }
            } 
            /* 장르선택 */
            else {
                /*성인*/
                if($age='all') {
                    /*최신순*/
                    if($view='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        and (genreId in ($genre))
                        order by openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                    
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*리뷰순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                        
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    }
                } 
                /*키즈*/
                else {
                    /*최신순*/
                    if($view='0') {
                        $sql = "SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        and (genreId in ($genre))
                        and adult=0
                        order by openDt desc;";
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        $sql = "SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;";
                    } 
                    /*리뷰순*/
                    else {
                        $sql = "SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r
                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;";
                    } 
                }
            }
            
            $res = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_row($res)) {
                
                $poster = $row[1];
                
                ?> 

                <article><img src=<?=$poster?>></article>

                <?php
            };
       ?>
    </div>
    
</body>
</html>