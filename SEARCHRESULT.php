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
    <br><br><br>
    <center>
    <form action="searchResearch.php" method="GET">
        
        <h1>Movie Recommender</h1>
    
        <input type="text" name="search_key" placeholder="Enter What You Like">
        <button type="submit" value="search">Search</button>

    </form>
    </center>

    <br><br>

    <hr>

    <br>

    <div class="serchresult">
        <h3>Search Result</h3>
        
        <?php $search_key = $_GET['search_key']; ?>

        <!--제목포함-->
        <div class="search_title">
            <p>* 제목 포함</p>
            <form action="searchResult.php" method="get">
                <?php 
                    $sql1 = "SELECT posterPath FROM movie_metadata WHERE movieNm LIKE '%$search_key%'";
                ?>
            </form>
            <?php
                 $result= mysqli_query($db, $sql1);
            
                 while($row = mysqli_fetch_array($result)) {
                
                        $poster = $row["posterPath"];
                
                ?>
                <article><img src=<?$poster?>></article>
                <?php
            }
            ?>
       ?>
        </div>

        <!--배우포함-->
        <div class="search_name">
            <p>* 배우 포함</p>
            <form action="searchResult.php" method="get">
                <?php 
                    $sql2 = "SELECT posterPath from movie_metadata

                    where movieId in (select movieId from characters where actorId = (SELECT actorId FROM actor WHERE actorName LIKE '%$search_key%'));";
                    
                ?>
            </form>
            <?php
                 $result= mysqli_query($db, $sql2);
            
                 while($row = mysqli_fetch_array($result)) {
                
                        $poster = $row["posterPath"];
                
                ?>
                <article><img src=<?$poster?>></article>
                <?php
            }
            ?>
        </div> 
        
        <div class="search_name">
            <p>* 감독 포함</p>
            <form action="searchResult.php" method="get">
                <?php 
                    $sql3 = "SELECT posterPath from movie_metadata

                    where directorId in (select directorId from director where directorName LIKE '%$search_key%');";
                    
                ?>
            </form>
            <?php
                 $result= mysqli_query($db, $sql3);
            
                 while($row = mysqli_fetch_array($result)) {
                
                        $poster = $row["posterPath"];
                
                ?>
                <article><img src=<?$poster?>></article>
                <?php
            }
            ?>
        </div> 
        
        <!--키워드포함-->
        <div class="search_keyword">
            <p>* 키워드 포함</p>
            <form action="searchResult.php" method="get">
                <?php 
                    $sql4 = "SELECT posterPath from movie_metadata

                    where movieId in (select movieId from describes
                    
                    where keywordId = (select keywordId from keyword where keywordName LIKE '%$search_key%'));";
                    
                ?>
            </form>
            <?php
                 $result= mysqli_query($db, $sql4);
            
                 while($row = mysqli_fetch_array($result)) {
                
                        $poster = $row["posterPath"];
                
                ?>
                <article><img src=<?$poster?>></article>
                <?php
            }
            ?>
        </div>
</body>
