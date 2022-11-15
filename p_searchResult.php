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

    <br><br>

    <hr>

    <br>

    <div class="result">
        <h3>Search Result</h3>
        
        <?php $search_key = $_POST['search_key']; ?>

        <!--제목포함-->
        <div>
            <p>* 제목 포함</p>
                <?php 
                    $sql1 = "SELECT posterPath FROM movie_metadata WHERE originalTitle LIKE '%$search_key%';";
               
                 $result_title= mysqli_query($conn, $sql1);
            
                 while($row1 = mysqli_fetch_row($result_title)) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row1[0]";
                
                ?>
                <article><img src=<?=$poster?>></article>
                <?php
                }
            ?>
        </div>
        <br><br>
        <!--배우포함-->
            
        <div>
            <p>* 배우 포함</p>
            <?php 
                $sql2 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from characters where actorId = (SELECT actorId FROM actor WHERE actorName LIKE '%$search_key%'));";
               
                 $result_actor= mysqli_query($conn, $sql2);
            
                 while($row2 = mysqli_fetch_row($result_actor)) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row2[0]";
                
                ?>
                <article><img src=<?=$poster?>></article>
                <?php
                }
            ?>
        </div>
            <br><br>

            <p>* 감독 포함</p>
            <div>
                <?php 
                    $sql3 = "SELECT posterPath from movie_metadata
                    where directorId in (select directorId from director where directorName LIKE '%$search_key%');";
                    
                ?>
            
            <?php
                 $result_director= mysqli_query($conn, $sql3);
            
                 while($row3 = mysqli_fetch_row($result_director)) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row3[0]";
                
                ?>
                <article><img src=<?=$poster?>></article>
                <?php
                }
            ?>
            </div>
        
        <!--키워드포함-->
            <br><br>    
            <div>
            <p>* 키워드 포함</p>
                <?php 
                    $sql4 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from describes
                    
                    where keywordId = (select keywordId from keyword where keywordName LIKE '%$search_key%'));";
                    
                ?>
            <?php
               $result_key= mysqli_query($conn, $sql4);
            
               while($row4 = mysqli_fetch_row($result_key)) {
              
                      $poster = "http://image.tmdb.org/t/p/w185/$row4[0]";
              
              ?>
              <article><img src=<?=$poster?>></article>
              <?php
              }
          ?>
          </div>
        
</body>