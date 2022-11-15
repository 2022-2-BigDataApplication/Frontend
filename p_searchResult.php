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
    <!--상단바-->
    <header>
            <h1>New Jelly</h1>
            <nav>
            <span><a href="logout.php">Logout</a></span>
            <span><a href="mypage.html">Mypage</a></span>
            </nav>
    </header>

    <br><br>
    <!--검색창-->
    <div class="text">
        <br><br><br>
        <center>
        <form action="p_searchResult.php" method="POST">
            
            <h2>Movie Recommender</h2>
            <br>
        
            <input type="text" name="search_key" placeholder="Enter What You Like"><br><br>
            <button>Submit</button>

        </form>
    </center>
    </div>
    <hr>

    <br>

    <div class="result">
        <h3>Search Result</h3>
        
        <?php $search_key = $_POST['search_key']; ?>
        
        
        <!--제목포함-->
        <div>
            <p>Title</p>
                <?php 
                    $sql1 = "SELECT posterPath FROM movie_metadata WHERE originalTitle LIKE '%$search_key%';";
               
                 $result_title= mysqli_query($connect, $sql1);
            
                 while($row1 = mysqli_fetch_row($result_title)) {
                        $poster = "http://image.tmdb.org/t/p/w185/$row1[0]";
                        $_Session['pathKey'] = $row1[0];
                ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
                <?php
                }
            ?>
        </div>
        <br><br>
        <!--배우포함-->
            
        <div>
            <p>Actor</p>
            <?php 
                $sql2 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from characters where actorId = ANY(SELECT actorId FROM actor WHERE actorName LIKE '$search_key'));";
               
                 $result_actor= mysqli_query($connect, $sql2);
            
                 while($row2 = mysqli_fetch_row($result_actor)) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row2[0]";
                        $_Session['pathKey'] = $row2[0];
                
                ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
                <?php
                }
            ?>
        </div>
            <br><br>

            <p>Director</p>
            <div>
                <?php 
                    $sql3 = "SELECT posterPath from movie_metadata
                    where directorId in (select directorId from director where directorName LIKE '$search_key');";
                    
                ?>
            
            <?php
                 $result_director= mysqli_query($connect, $sql3);
            
                 while($row3 = mysqli_fetch_row($result_director)) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row3[0]";
                        $_Session['pathKey'] = $row3[0];
                
                ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
                <?php
                }
            ?>
            </div>
        
        <!--키워드포함-->
            <br><br>    
            <div>
            <p>Keyword</p>
                <?php 
                    $sql4 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from describes
                    where keywordId = any(select keywordId from keyword where keywordName LIKE '%$search_key%'));";
                    
                ?>
            <?php
               $result_key= mysqli_query($connect, $sql4);
            
               while($row4 = mysqli_fetch_row($result_key)) {
              
                      $poster = "http://image.tmdb.org/t/p/w185/$row4[0]";
                      $_Session['pathKey'] = $row4[0];
              
              ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
              <?php
              }
          ?> </div>
              <?php mysqli_close($connect);?>
    </div>
</body>