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
        <span>
            <p>Title</p>
                <?php 
                    $sql1 = "SELECT posterPath FROM movie_metadata WHERE originalTitle LIKE '%$search_key%';";
               
                    $result_title= mysqli_query($connect, $sql1);
                    $count1 = 0;
                     while($row2 = mysqli_fetch_row($result_title) and $count1<10) {
                    
                            $poster = "http://image.tmdb.org/t/p/w185/$row2[0]";
                            $_Session['pathKey'] = $row2[0];
                        
                    ?>
                    <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
                    <?php
                    $count1++;
                    }
                ?>
        </span>
        <br><br>
        
        <!--배우일치-->    
        <span>
            <p>Actor</p>
            <?php 
                $sql2 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from characters where actorId = ANY(SELECT actorId FROM actor WHERE actorName LIKE '$search_key'));";
               
                 $result_actor= mysqli_query($connect, $sql2);
                 $count2 = 0;
                 while($row2 = mysqli_fetch_row($result_actor) and $count2<10) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row2[0]";
                        $_Session['pathKey'] = $row2[0];
                
                ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
                <?php
                $count2++;
                }
            ?>
        </span>
            <br><br>

            <span>
                <p>Director</p>
                <?php 
                    $sql3 = "SELECT posterPath from movie_metadata
                    where directorId in (select directorId from director where directorName LIKE '$search_key');";
                    
                ?>
            
            <?php
                 $result_director= mysqli_query($connect, $sql3);
                 $count3 = 0;
                 while($row3 = mysqli_fetch_row($result_director) and $count3<10) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row3[0]";
                        $_Session['pathKey'] = $row3[0];
                    
                ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
                <?php
                $count3++;
                }
            ?>
            </span>
        
        <!--키워드포함-->
            <br><br>    
            <span>
            <p>Keyword</p>
                <?php 
                    $sql4 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from describes
                    where keywordId = any(select keywordId from keyword where keywordName LIKE '%$search_key%'));";
                    
                ?>
            <?php
               $result_key= mysqli_query($connect, $sql4);
               $count4 = 0;

               while($row4 = mysqli_fetch_row($result_key) and $count4<10) {
              
                      $poster = "http://image.tmdb.org/t/p/w185/$row4[0]";
                      $_Session['pathKey'] = $row4[0];
              
              ?>
                <article><a href="movieSession.php"><img src=<?=$poster?>></a></article>
              <?php
              $count4++;
              }
          ?> </span>
            <?php
                mysqli_free_result($result_title);
                mysqli_free_result($result_actor);
                mysqli_free_result($result_director);
                mysqli_free_result($result_key);
                mysqli_close($connect);
            ?>
    </div>
</body>

