<?php
include('log_check.php');
include('dbconn.php');
$movie = $_SESSION['movieId'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="moviedetail.css">
</head>
<header>
<h1><a href="p_MAIN.php">New Jelly</a></h1>
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
  <body>
  <main>
    <div class="movie-info1"> <!--movie information image, title, etc-->
      <div class="poster-image-div">
        <?php
        $data_sql = "SELECT posterPath from movie_metadata where movieId = '".$_SESSION['movieId']."'";
        $data_resource = mysqli_query($connect, $data_sql);
        $data_row = mysqli_fetch_row($data_resource);

        $test_sql = "SELECT originalTitle from movie_metadata where movieId = '".$_SESSION['movieId']."'";
        $test_resource = mysqli_query($connect, $test_sql);
        $test_row = mysqli_fetch_row($test_resource);
        ?>
        <img src= "http://image.tmdb.org/t/p/w185<?=$data_row[0]?>" style="width:185px; height:265px;" onerror = "this.src='NoImage.png'; this.style='width:185px; height:265px;'">
      </div>
      <div class="movie-info3">
            <?php
            $info_sql = "SELECT m.originalTitle, m.openDt, g.genreName, c.countryName from movie_metadata as m inner join genre as g on m.genreId = g.genreId inner join country as c on m.countryId = c.countryId where movieId = '".$_SESSION['movieId']."'";
            $info_resource = mysqli_query($connect, $info_sql);
            $info_row = mysqli_fetch_row($info_resource);

            $company_sql = "SELECT companyName from movie_company mc inner join company c on c.companyId = mc.companyId where movieId = '".$_SESSION['movieId']."'";
            $company_resource = mysqli_query($connect, $company_sql);
            $company_row = mysqli_fetch_row($company_resource);
            ?>         
        <div class="movie-title">
            <h3><?php echo $info_row[0]; ?></h3>
        </div>
        <div class="movie-score">
          <?php
            $score_sql = "SELECT avg(rating),count(*) as count from review where movieId = '".$_SESSION['movieId']."';";
            $score_resourse = mysqli_query($connect, $score_sql);
            $score_row = mysqli_fetch_row($score_resourse);
          ?>
          <table class="score-table">
            <tr>
              <td>score: <?php echo $score_row[0];?></td>
              <td>participants: <?php echo $score_row[1];?></td>
            </tr>
          </table>
        </div>
        <div class="movie-info4">
          <table class="movie-info4">
            <?php
            if($company_row[0]==NULL){
              $company = 'Non';
            } else {
              $company = $company_row[0];
            }
            echo "<TR><TD>", $info_row[1],"</TD><TD>",$info_row[2],"</TD><TD>",$info_row[3],"</TD><TD>",$company,"</TD></TR>"
            ?>
          </table>
        </div>
      </div>
    </div>

    <div class="movie-info2"><!--movie infromation plot, director, actors-->
      <p style="font-size: 25px; font-weight: bold;">Movie Plot</p>
      <?php
      $plot_sql = "SELECT overview from movie_metadata where movieId='".$_SESSION['movieId']."'";
      $plot_resource = mysqli_query($connect, $plot_sql);
      $plot_row = mysqli_fetch_row($plot_resource);
      echo "<font-size: 15px>",$plot_row[0],"</font>";
      ?>
          <div> <!--배우 배역 나열 표-->
            <table style="text-align: center; padding-top: 10px"> 
              <?php
                $char_sql = "SELECT a.actorName from actor as a
                  inner join characters as c on a.actorId = c.actorId
                  where movieId = $movie order by c.characterOrder LIMIT 5;";
                $char_resource = mysqli_query($connect, $char_sql);
              ?>
              <tr>
                <th scope ="row" style="width: 80px; border: 1px solid #444444;">Actor</th>
                <?php
                  while ($char_row = mysqli_fetch_row($char_resource)){
                ?>
                  <td style="width: 130px; border: 1px solid #444444;"><?php echo $char_row[0]?></td><?php } ?>

                <?php
                  $char_sql = "SELECT c.characterName from actor as a
                    inner join characters as c on a.actorId = c.actorId
                    where movieId = $movie order by c.characterOrder LIMIT 5;";
                  $char_resource = mysqli_query($connect, $char_sql);
                ?>
              <tr>
                <th scope ="row" style="width: 80px; border: 1px solid #444444;">Character</th>
                <?php
                  while ($char_row = mysqli_fetch_row($char_resource)){
                ?>
                  <td style="width: 130px ; border: 1px solid #444444;"><?php echo $char_row[0]?></td><?php } ?>
              </table>
            </div>
    </div>

    <div class="comment-recent"><!--movie comments (3) recent-->
        <div class="comment-header">
            <h1>Recent Comments</h1>
            <?php
              if($jb_login){ ?>
                <nav>
                    <span><a href="p_CommentTyping.php">Type</a></span>
                    <span><a href="p_ViewComment.php">View</a></span>
                </nav>
            <?php } else { ?>
              <nav>
                    <span><a href="p_login.php">Login</a></span>
                    <span><a href="p_ViewComment.php">View</a></span>
                </nav>
            <?php }?>
        </div>
      <?php
        
        $recent_sql = "SELECT reviewTime, rating, comments from review where movieId = $movie ORDER BY reviewTime desc;";
        $recent_resource = mysqli_query($connect, $recent_sql);
      ?>

      <div class="recent"> <!--recent comment-->
        <div class="array" style="overflow: hidden; height:auto;">
          <table>
            <thead>
              <tr>
                <th style="width: 250px">Date</th>
                <th style="width: 100px">Score</th>
                <th>Comments</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($recent_row = mysqli_fetch_row($recent_resource)){
                  ?>
                  <tr>
                  <td><?php echo $recent_row[0]?></td>
                  <td><?php echo $recent_row[1]?></td>
                  <td><?php echo $recent_row[2]?></td>
                  </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <?php 
  mysqli_free_result($data_resource);
  mysqli_free_result($test_resource);
  mysqli_free_result($info_resource);
  mysqli_free_result($company_resource);
  mysqli_free_result($score_resourse);
  mysqli_free_result($plot_resource);
  mysqli_free_result($recent_resource);
  mysqli_close($connect);
  ?>
</body>
</html>