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
    <h1><a href="p_MAIN.php"style="color:white; text-decoration: none;"s>New Jelly</a></h1>
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
              <td><?php echo $score_row[0];?></td>
              <td><?php echo $score_row[1];?></td>
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
    <article style = "border: 1px #a39485 solid;
  box-shadow: 0 2px 5px rgba(0,0,0,.25);
  width: 100%;
  border-collapse: collapse;
  border-radius: 5px;
  overflow: hidden;
  margin-bottom:50px;
  padding-left:50px;
  padding-right:50px;"><p style="color: #73685d; font-size: 25px; font-weight: bold;">Movie Plot</p>
      <?php
      $plot_sql = "SELECT overview from movie_metadata where movieId='".$_SESSION['movieId']."'";
      $plot_resource = mysqli_query($connect, $plot_sql);
      $plot_row = mysqli_fetch_row($plot_resource);
      echo "<p style = \"font-size: 15px; margin-bottom: 20px;\">",$plot_row[0],"</p>";
      ?></article>
          <div> <!--배우 배역 나열 표-->
          <table style="border: 1px #a39485 solid;
            font-size: .9em;
            box-shadow: 0 2px 5px rgba(0,0,0,.25);
            width: 100%;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;"> 
              <?php
                $char_sql = "SELECT a.actorName from actor as a
                  inner join characters as c on a.actorId = c.actorId
                  where movieId = $movie order by c.characterOrder LIMIT 5;";
                $char_resource = mysqli_query($connect, $char_sql);
              ?>
              <tr>
              <th scope ="row" style="text-align: left;
                font-weight: bold;
                color: #fff;
                background: #73685d;
                padding: 1em .5em;
                vertical-align: middle;">Actor</th>
                <?php
                  while ($char_row = mysqli_fetch_row($char_resource)){
                ?>
                  <td style="padding: 1em .5em;
                  vertical-align: middle;border-bottom: 1px solid rgba(0,0,0,.1);
                  background: #fff;"><?php echo $char_row[0]?></td><?php } ?>

                <?php
                  $char_sql = "SELECT c.characterName from actor as a
                    inner join characters as c on a.actorId = c.actorId
                    where movieId = $movie order by c.characterOrder LIMIT 5;";
                  $char_resource = mysqli_query($connect, $char_sql);
                ?>
              <tr>
              <th scope ="row" style="text-align: left;
                font-weight: bold;
                color: #fff;
                background: #73685d;
                padding: 1em .5em;
                vertical-align: middle;">Character</th>
                <?php
                  while ($char_row = mysqli_fetch_row($char_resource)){
                ?>
                  <td style="padding: 1em .5em;
                  vertical-align: middle;border-bottom: 1px solid rgba(0,0,0,.1);
                  background: #fff;"><?php echo $char_row[0]?></td><?php } ?>
              </table>
            </div>
    </div>
    <br><br><br><br><br><br>
    <div class="comment-recent"><!--movie comments (3) recent-->
        <div class="comment-header">
            <h1>Insert Review</h1>
                <nav>
                    <span><a href="p_CommentTyping.php">Type</a></span>
                    <span><a href="p_ViewComment.php">View</a></span>
                </nav>
        </div>
        
      <div class = "comment-type">
        <form action="write.php" method = "post">
          <textarea class="comment-area" maxlength="500" name = "comment" placeholder="comment area" required>
          </textarea> <br>
          <select name="score">
            <option>review score</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select> <br>
          <input type="submit" name="submit" size="50" value="Done" style="height:30px; width:50px; background-color: green; border: 0px; color: white; font-weight: bold; margin-top: 10px;"/>
        </form>
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
      mysqli_free_result($char_resource);
      mysqli_close($connect); ?>
</body>
</html>