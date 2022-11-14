<?php include('header.php')?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">

    <!--이미지 float style-->
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
    <div class="filter">
        <form action="result.php" method="get">
            
            <!--filter html-->
            <p>Option Selection</p>
            
            RelesedDate:<input type="text" name="start_year" placeholder="start_year">
                        <input type="text" name="end_year" placeholder="end_year">
                        <br>
                            
            Genre : <input type="radio" name="genre" value="21">All
                    <input type="radio" name="genre" value="16">Animation
                    <input type="radio" name="genre" value="12">Adventure
                    <input type="radio" name="genre" value="10749">Romance
                    <input type="radio" name="genre" value="35">Comedy
                    <input type="radio" name="genre" value="28">Action
                    <input type="radio" name="genre" value="10751">Family
                    <input type="radio" name="genre" value="36">History
                    <input type="radio" name="genre" value="18">Drama
                    <input type="radio" name="genre" value="80">Crime
                    <input type="radio" name="genre" value="878">Science Fiction
                    <input type="radio" name="genre" value="14">Fantasy
                    <input type="radio" name="genre" value="10402">Music
                    <input type="radio" name="genre" value="27">Horror
                    <input type="radio" name="genre" value="99">Documentary
                    <input type="radio" name="genre" value="9648">Mystery
                    <input type="radio" name="genre" value="53">Thriller
                    <input type="radio" name="genre" value="37">Western
                    <input type="radio" name="genre" value="10770">TV Movie
                    <input type="radio" name="genre" value="10752">War
                    <input type="radio" name="genre" value="10769">Foreign
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
            $start_year= $_GET[start_year];
            $end_year= $_GET[end_year];
            $genre= $_GET[genre]; 
            $age= $_GET[age];
            $view= $_GET[view];

            /*ALL 아니면 선택으로 바꾸자 */
            if($genre='21') {
                if($age='all') {
                    /* 장르 all+19금 포함 */
                    if($view='0') {
                        $sql1 = mq("SELECT movieId, url
                                    FROM movie_metadata
                                    WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$start_year' AND '$end_year')
                                    ORDER BY openDt desc;");
                    
                    } 
                    /*높은 별점순*/
                    else if($view='1') {
                        $sql1 = mq("SELECT M.movieId, M.url, avg(R.score) AS 'score_avg'
                        FROM review AS R
                        INNER JOIN movie_metadata AS M ON R.movieId = M.movieId
                        WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$year_start' AND '$year_end')
                        GROUP BY movieId
                        ORDER BY socre_avg desc;
                        ");
                    } 
                    /*코멘트 많은순*/
                    else {
                        $sql1 = mq("SELECT m.movieCd, m.url, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieCd = m.movieCd
                        where (DATE_FORMAT(openDt, '%Y%m') BETWEEN '$start_year' AND '$end_year') 
                        GROUP BY movieCd
                        order by review_num desc;
                        ");
                    }
                } else {
                    /* 장르 all+19금 제외 */
                    if($view='0') {
                        $sql1 = mq("SELECT movieId, url
                                    FROM movie_metadata
                                    WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$start_year' AND '$end_year')
                                    AND adult='0'
                                    ORDER BY openDt desc;");
                    
                    } 
                    /*높은 별점순*/
                    else if($view='1') {
                        $sql1 = mq("SELECT M.movieId, M.url, avg(R.score) AS 'score_avg'
                        FROM review AS R
                        INNER JOIN movie_metadata AS M ON R.movieId = M.movieId
                        WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$year_start' AND '$year_end')
                        AND adult='0'
                        GROUP BY movieId
                        ORDER BY socre_avg desc;
                        ");
                    } 
                    /*코멘트 많은순*/
                    else {
                        $sql1 = mq("SELECT m.movieCd, m.url, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieCd = m.movieCd
                        where (DATE_FORMAT(openDt, '%Y%m') BETWEEN '$start_year' AND '$end_year')
                        AND adult='0' 
                        GROUP BY movieCd
                        order by review_num desc;
                        ");
                    }
                }
            } else {
                if($age='all') {
                    /* 장르 선택+19금 포함 */
                    if($view='0') {
                        $sql1 = mq("SELECT movieId, url
                                    FROM movie_metadata
                                    WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$start_year' AND '$end_year')
                                    AND gernId='$genre'
                                    ORDER BY openDt desc;");
                    
                    } 
                    /*높은 별점순*/
                    else if($view='1') {
                        $sql1 = mq("SELECT M.movieId, M.url, avg(R.score) AS 'score_avg'
                        FROM review AS R
                        INNER JOIN movie_metadata AS M ON R.movieId = M.movieId
                        WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$year_start' AND '$year_end')
                        AND M.gernId='$genre'
                        GROUP BY movieId
                        ORDER BY socre_avg desc;
                        ");
                    } 
                    /*코멘트 많은순*/
                    else {
                        $sql1 = mq("SELECT m.movieCd, m.url, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieCd = m.movieCd
                        where (DATE_FORMAT(openDt, '%Y%m') BETWEEN '$start_year' AND '$end_year') 
                        AND M.gernId='$genre'
                        GROUP BY movieCd
                        order by review_num desc;
                        ");
                    }
                } else {
                    /* 장르 선택+19금 제외 */
                    if($view='0') {
                        $sql1 = mq("SELECT movieId, url
                                    FROM movie_metadata
                                    WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$start_year' AND '$end_year')
                                    AND adult='0'
                                    AND M.gernId='$genre'
                                    ORDER BY openDt desc;");
                    
                    } 
                    /*높은 별점순*/
                    else if($view='1') {
                        $sql1 = mq("SELECT M.movieId, M.url, avg(R.score) AS 'score_avg'
                        FROM review AS R
                        INNER JOIN movie_metadata AS M ON R.movieId = M.movieId
                        WHERE (DATE_FORMAT(openDt, '%Y') BETWEEN '$year_start' AND '$year_end')
                        AND adult='0'
                        AND M.gernId='$genre'
                        GROUP BY movieId
                        ORDER BY socre_avg desc;
                        ");
                    } 
                    /*코멘트 많은순*/
                    else {
                        $sql1 = mq("SELECT m.movieCd, m.url, count(*) AS `review_num`FROM review as r
                        inner join movie_metadata as m on r.movieCd = m.movieCd
                        where (DATE_FORMAT(openDt, '%Y%m') BETWEEN '$start_year' AND '$end_year')
                        AND adult='0'
                        AND M.gernId='$genre'
                        GROUP BY movieCd
                        order by review_num desc;
                        ");
                    }
                }
            }
       
            while($movie = $sql->mysqli_fetch_array()) {
                
                $movie_id = $movies["movie_id"];
                ?> 

                <article><img src="url"></article>

                <?php
            }
       ?>
    </div>
</body>
</html>