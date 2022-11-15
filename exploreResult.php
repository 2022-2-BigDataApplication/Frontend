<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
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
    <div id="filter">

        <form action="exploreResult.php" method="get">
            <p>Option Selection</p>
            
            RelesedDate:<input type="number" name="start_year" placeholder="start_year">
                        <input type="number" name="end_year" placeholder="end_year">
                        <br>
                            
            Genre : <input type="radio" name="genre[]" value="21">All
                    <input type="radio" name="genre[]" value="16">Animation
                    <input type="radio" name="genre[]" value="12">Adventure
                    <input type="radio" name="genre[]" value="10749">Romance
                    <input type="radio" name="genre[]" value="35">Comedy
                    <input type="radio" name="genre[]" value="28">Action
                    <input type="radio" name="genre[]" value="10751">Family
                    <input type="radio" name="genre[]" value="36">History
                    <input type="radio" name="genre[]" value="18">Drama
                    <input type="radio" name="genre[]" value="80">Crime
                    <input type="radio" name="genre[]" value="878">Science Fiction
                    <input type="radio" name="genre[]" value="14">Fantasy
                    <input type="radio" name="genre[]" value="10402">Music
                    <input type="radio" name="genre[]" value="27">Horror
                    <input type="radio" name="genre[]" value="99">Documentary
                    <input type="radio" name="genre[]" value="9648">Mystery
                    <input type="radio" name="genre[]" value="53">Thriller
                    <input type="radio" name="genre[]" value="37">Western
                    <input type="radio" name="genre[]" value="10770">TV Movie
                    <input type="radio" name="genre[]" value="10752">War
                    <input type="radio" name="genre[]" value="10769">Foreign
                    <br>

            Age Limitation:<input type="radio" name="age" value="all">All
                            <input type="radio" name="age" value="kids">Kids
                    <br>

            Viewing : <select name="view">
                <option value="0">Recently Released</option>
                <option value="1">Highly Scored</option>
                <option value="2">Most Commented</option>
            </select>   
                    <br>
            <hr>
        </form>
    </div>

    <div id="wrap">
        <?php
            $start_year= $_GET['start_year'];
            $end_year= $_GET['end_year'];
            $genre= $_GET['genre']; 
            $age= $_GET['age'];
            $view= $_GET['view'];

            /* 장르전체 */
            if($genre[0]='21') {
                /*성인*/
                if($age='all') {
                    /*최신순*/
                    if($view='0') {
                        sql = mq("SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))

                        order by openDt desc;")
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        sql = mq("SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
 
                        GROUP BY m.movieId
                        
                        order by review_num desc;")
                    } 
                    /*리뷰순*/
                    else {
                        sql = mq("SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))

                        GROUP BY m.movieId
                        
                        order by rating_avg desc;")
                    }
                } 
                /*키즈*/
                else {
                    if($view='0') {
                        sql = mq("SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))

                        and adult=0
                        order by openDt desc;")
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        sql = mq("SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))

                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;")
                    } 
                    /*리뷰순*/
                    else {
                        sql = mq("SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
        
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;")
                    }
                }
            } 
            /* 장르선택 */
            else {
                /*성인*/
                if($age='all') {
                    /*최신순*/
                    if($view='0') {
                        sql = mq("SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        and (genreId in ($genre))
                        order by openDt desc;")
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        sql = mq("SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                    
                        GROUP BY m.movieId
                        
                        order by review_num desc;")
                    } 
                    /*리뷰순*/
                    else {
                        sql = mq("SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                        
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;")
                    }
                } 
                /*키즈*/
                else {
                    /*최신순*/
                    if($view='0') {
                        sql = mq("SELECT originalTitle, posterPath FROM movie_metadata
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        and (genreId in ($genre))
                        and adult=0
                        order by openDt desc;")
                    } 
                    /*별점순*/
                    else if ($view='1') {
                        sql = mq("SELECT m.originalTitle, m.posterPath, count(*) AS `review_num`FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by review_num desc;")
                    } 
                    /*리뷰순*/
                    else {
                        sql = mq("SELECT m.originalTitle, m.posterPath, avg(r.rating) AS `rating_avg` FROM review as r

                        inner join movie_metadata as m on r.movieId = m.movieId
                        
                        where CAST($end_year AS CHAR(4)) >= (DATE_FORMAT(openDt, '%Y%m') >= CAST($start_year AS CHAR(4)))
                        
                        and (genreId in $genre)
                        and adult=0
                        GROUP BY m.movieId
                        
                        order by rating_avg desc;")
                    
                    } 
                }
            }
            
            $result= mysqli_query($db, $sql)
            
            while($row = mysqli_fetch_array($result)) {
                
                $poster = $row["posterPath"];
                
                ?> 

                <article><img src=<?=$poster?>></article>

                <?php
            }
       ?>
    </div>
    
</body>
</html>
