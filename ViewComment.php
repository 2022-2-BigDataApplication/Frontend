<?php
session_start();
include('log_check.php');
include('dbconn.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="moviedetail.css">
</head>
<header>
    <h1>New Jelly</h1>
    <?php
        if(isset($_SESSION['userId'])) {
    ?>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="Mypage.php">Mypage</a></span>
    </nav>
    <?php
        } else {
    ?>
    <nav>
      <span><a href="login.php">Login</a></span>
      <span><a href="join.php">Join</a></span>
    </nav>
    <?php } ?>
</header>
  <body>
  <main>
    <div class="movie-info1"> <!--movie information image, title, etc-->
      <div class="poster-image-div">
        <?php
        $movieId = $_SESSION['movieId'];
        $img_sql = "SELECT * from movie_metadata where movieId='$movieId'";
        $img_resource = mysql_query($img_sql);
        $img_row = mysql_fetch_row($img_resource);
        ?>
        <img src="<?=$img_row[7]?>" alt="Movie poster">
      </div>
      <div class="movie-info3">
        <div class="movie-title">
            <?php
            $movieId = $_SESSION['movieId'];
            $title_sql = "SELECT * from movie_metadata where movieId='$movieId'";
            $title_resource = mysql_query($title_sql);
            $title_row = mysql_fetch_row($title_resource);
            echo $title_row[3];
            ?> 
            <!--print($title_row[3])-->
        </div>
        <div class="movie-score">
          <table class="score-table">
            <tr>
              <td>start score |</td>
              <td>volunteer</td>
            </tr>
          </table>
        </div>
        <div class="movie-info4">
          <table class="movie-info4">
            <?php
            $movieId = $_SESSION['movieId'];
            $meta_sql = "SELECT * from movie_metadata where movieId='$movieId'";
            $genre_sql = "SELECT * from genre where genreId='$meta_row[9]'";
            $nation_sql = "SELECT * from country where countryId='$meta_row[10]'";
            $direct_sql = "SELECT * from country where countryId='$meta_row[8]'";

            $meta_resource = mysql_query($meta_sql);
            $meta_row = mysql_fetch_row($meta_resource);
            $genre_resource = mysql_query($genre_sql);
            $genre_row = mysql_fetch_row($genre_resource);
            $nation_resource = mysql_query($nation_sql);
            $nation_row = mysql_fetch_row($nation_resource);
            $direct_resource = mysql_query($direct_sql);
            $direct_row = mysql_fetch_row($direct_resource);

            echo "<TR><TD>", $meta_row[6],"</TD><TD>",$genre_row[1],"</TD><TD>",$nation_row[1],"</TD><TD>",$direct_row[1],"</TD></TR>"
            ?>
          </table>
        </div>
      </div>
    </div>

    <div class="movie-info2"><!--movie infromation plot, director, actors-->
      <p style="font-size: 25px;">Movie Plot</p>
      <?php
      $movieId = $_SESSION['movieId'];
      $plot_sql = "SELECT * from movie_metadata where movieId='$movieId'";
      $plot_resource = mysql_query($plot_sql);
      $plot_row = mysql_fetch_row($plot_resource);
      echo "<font-size: 15px>",$plot_row[4],"</font>";
      ?>
    </div>

    <div class="comment-recent"><!--movie comments all recent-->
    <?php
        /*모든 코멘트 불러오는 sql문*/
    ?>
        <table>
            <thead>
              <tr>
                <th>Data</th><th>Score</th><th>Comments</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while ($array_row = mysql_fetch_row($array_resource)){
                echo
                  '<p>'
                    . $array_row[0]
                    . $array_row[2]
                    . $array_row[3]
                    . $array_row[4]
                    . '</p>'
                ;
              }
            ?>
            </tbody>
        </table>
    </div>

  </main>
</body>
</html>