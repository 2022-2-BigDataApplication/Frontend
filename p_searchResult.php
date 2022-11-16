<?php
include('dbconn.php');
include 'log_check.php';
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="search.css">

</head>

<body>
    <!--상단바-->
<header>
    <h1>New Jelly</h1>
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

    <br><br>
    <!--검색창-->
    <div class="filter">
        <br><br><br>
        <form action="p_searchResult.php" method="POST">
            <h2>Movie Recommender</h2>
            <div class="filtering">
                <br><br><br>
                <input type="text" name="search_key" placeholder="Enter What You Like">
                <button>Submit</button>
            </div>
        </form>
    </div>

    <div class="result">
        <h3>Search Result</h3>
        
        <?php $search_key = $_POST['search_key']; ?>

        <!--제목포함-->
        <div class="A">
            <p>Title</p>
                <?php 
                    $sql1 = "SELECT posterPath FROM movie_metadata WHERE originalTitle LIKE '%$search_key%';";
               
                    $result_title= mysqli_query($connect, $sql1);
                    $count1 = 0;
                     while($row2 = mysqli_fetch_row($result_title) and $count1 <10) {
                    
                            $poster = $row2[0];
                            if(isset($_SESSION['pathKey'])){
                                unset($_SESSION['pathKey']);
                                $_SESSION['pathKey'] = $poster;
                            } else {
                                $_SESSION['pathKey'] = $poster;
                            }
                            
                        
                    ?>
                    <article><a href="movieSession.php"><img src="http://image.tmdb.org/t/p/w185/<?=$poster?>"></a></article>
                    <?php
                    $count1++;
                    }
                ?>
        </div>
        
        <!--배우 일치-->    
        <div class="A">
            <p>Actor</p>
            <?php 
                $sql2 = "SELECT posterPath from movie_metadata
                    where movieId in (select movieId from characters where actorId = ANY(SELECT actorId FROM actor WHERE actorName LIKE '$search_key'));";
               
                 $result_actor= mysqli_query($connect, $sql2);
                 $count2 = 0;
                 while($row2 = mysqli_fetch_row($result_actor) and $count2<10) {
                
                        $poster = $row2[0];
                        if(isset($_SESSION['pathKey'])){
                            unset($_SESSION['pathKey']);
                            $_SESSION['pathKey'] = $poster;
                        } else {
                            $_SESSION['pathKey'] = $poster;
                        }
                
                ?>
                <article><a href="movieSession.php"><img src="http://image.tmdb.org/t/p/w185/<?=$poster?>"></a></article>
                <?php
                $count2++;
                }
            ?>
        </div>

        <!--감독 일치-->
        <div class="A">
                <p>Director</p>
                <?php 
                    $sql3 = "SELECT posterPath from movie_metadata
                    where directorId in (select directorId from director where directorName LIKE '$search_key');";
                    
                ?>
            
                <?php
                 $result_director= mysqli_query($connect, $sql3);
                 $count3 = 0;
                 while($row3 = mysqli_fetch_row($result_director) and $count3<10) {
                
                        $poster = $row3[0];
                        if(isset($_SESSION['pathKey'])){
                            unset($_SESSION['pathKey']);
                            $_SESSION['pathKey'] = $poster;
                        } else {
                            $_SESSION['pathKey'] = $poster;
                        }
                    
                ?>
                <article><a href="movieSession.php"><img src="http://image.tmdb.org/t/p/w185/<?=$poster?>"></a></article>
                <?php
                $count3++;
                }
                ?>
        </div>
        
        <!--키워드포함-->   
            <div class="A">
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
                      $poster = $row4[0];
                      if(isset($_SESSION['pathKey'])){
                        unset($_SESSION['pathKey']);
                        $_SESSION['pathKey'] = $poster;
                    } else {
                        $_SESSION['pathKey'] = $poster;
                    }
              
              ?>
                <article><a href="movieSession.php"><img src="http://image.tmdb.org/t/p/w185/<?=$poster?>"></a></article>
              <?php
              $count4++;
              }?> 
            </div>
            <?php
                mysqli_free_result($result_title);
                mysqli_free_result($result_actor);
                mysqli_free_result($result_director);
                mysqli_free_result($result_key);
                mysqli_close($connect);
            ?>
    </div>
</body>