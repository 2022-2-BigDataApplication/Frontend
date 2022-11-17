<?php
include('dbconn.php');
include ('log_check.php');
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
        <h3 align = "center">Search Result</h3>
        
        <?php $search_key = $_POST['search_key']; ?>
              
        <!--제목포함-->
        <div>
            <p align = "center">Title</p>
                <table><?php 
                    $sql1 = "SELECT originalTitle, posterPath FROM movie_metadata WHERE originalTitle LIKE '%$search_key%' AND length(posterPath) > 0;";
               
                    $result_title= mysqli_query($connect, $sql1);
                    $count1 = 0;
                     while($row1 = mysqli_fetch_row($result_title) and $count1<12) {
                    
                            $poster = "http://image.tmdb.org/t/p/w185/$row1[1]";
                            $title1 = $row1[0];

                            if ($count1%4==0){
                                echo "<tr>";
                            }
                    ?>
                    <td><img src=<?=$poster?> style="width:185px; height:265px;" onerror = "this.src='NoImage.png'; this.style='width:185px; height:265px;'"/>
                        <form action="movieSession.php" method="POST">
                        <input type="submit" name="pathKey" value ="<?=$title1?>" align = "middle" style="height:50px; width:185px;">
                        </form>
                    </td>
                    <?php
                    if ($count1%4==3){
                        echo "</tr>";
                    }
                    $count1++;
                    }
                ?></table>
        </div>
        <br><br>
        
        <!--배우 일치-->    
        <div>
            <p align = "center">Actor</p>
            <table><?php 
                $sql2 = "SELECT originalTitle, posterPath from movie_metadata
                    where movieId in (select movieId from characters where actorId = ANY(SELECT actorId FROM actor WHERE actorName LIKE '$search_key')) AND length(posterPath) > 0;";
               
                 $result_actor= mysqli_query($connect, $sql2);
                 $count2 = 0;
                 while($row2 = mysqli_fetch_row($result_actor) and $count2<12) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row2[1]";
                        $title2 = $row2[0];
                        if ($count2%4==0){
                            echo "<tr>";
                        }
                ?>
                    <td>
                    <img src=<?=$poster?> style="width:185px; height:265px;" onerror = "this.src='NoImage.png'; this.style='width:185px; height:265px;'"/>
                    <form action="movieSession.php" method="POST">
                        <input type="submit" name="pathKey" value ="<?=$title2?>" align = "middle" style="height:50px; width:185px;">
                        </form>
                    </td>
                <?php
                if ($count2%4==3){
                    echo "</tr>";
                }
                $count2++;
                }
            ?></table>
        </div>
            <br><br>

        <!--감독 일치-->
        <div>
                <p align = "center">Director</p>
                <table><?php 
                    $sql3 = "SELECT posterPath from movie_metadata
                    where directorId in (select directorId from director where directorName LIKE '$search_key') AND length(posterPath) > 0;";
                    
                ?>
            
            <?php
                 $result_director= mysqli_query($connect, $sql3);
                 $count3 = 0;
                 while($row3 = mysqli_fetch_row($result_director) and $count3<12) {
                
                        $poster = "http://image.tmdb.org/t/p/w185/$row3[1]";
                        $title3 = $row3[0];
                        if ($count3%4==0){
                            echo "<tr>";
                        }
                ?>
                    <td>
                    <img src=<?=$poster?> style="width:185px; height:265px;" onerror = "this.src='NoImage.png'; this.style='width:185px; height:265px;'"/>
                    <form action="movieSession.php" method="POST">
                        <input type="submit" name="pathKey" value ="<?=$title3?>" align = "middle" style="height:50px; width:185px;">
                        </form>
                    </td>
                <?php
                if ($count3%4==3){
                    echo "</tr>";
                }
                $count3++;
                }
            ?></table>
        </div>
        
        <!--키워드포함-->
        <br><br>    
        <div>
            <p align = "center">Keyword</p>
            <table><?php 
                    $sql4 = "SELECT originalTitle, posterPath from movie_metadata
                    where movieId in (select movieId from describes
                    where keywordId = any(select keywordId from keyword where keywordName LIKE '%$search_key%')) AND length(posterPath) > 0;";
                    
                ?>
            <?php
               $result_key= mysqli_query($connect, $sql4);
               $count4 = 0;

               while($row4 = mysqli_fetch_row($result_key) and $count4<12) {
              
                      $poster = "http://image.tmdb.org/t/p/w185/$row4[1]";
                      $title4 = $row4[0];
                      if ($count4%4==0){
                        echo "<tr>";
                    }
              ?>
                    <td>
                        <img src=<?=$poster?> style="width:185px; height:265px;" onerror = "this.src='NoImage.png'; this.style='width:185px; height:265px;'"/>
                    <form action="movieSession.php" method="POST">
                        <input type="submit" name="pathKey" value ="<?=$title4 ?>" align = "middle" style="height:50px; width:185px;">
                        </form>
                    </td>
              <?php
                if ($count4%4==3){
                echo "</tr>";
                }
              $count4++;
              }
            ?></table>
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

