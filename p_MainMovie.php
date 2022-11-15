<?php
session_start();
include('dbconn.php');
include('log_check.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="moviedetail.css">
</head>
<header>
    <h1>New Jelly</h1>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="mypage.html">Mypage</a></span>
    </nav>
</header>
  <body>
  <main>
    <div class="movie-info1"> <!--movie information image, title, etc-->
      <div class="poster-image-div">
        <?php
        $movieId = $_SESSION['movieId'];
        $img_sql = "SELECT * from movie_metadata where movieId='$movieId'";
        $img_resource = mysqli_query($img_sql);
        $img_row = mysqli_fetch_row($img_resource);
        ?>
        <img src="<?=$img_row[7]?>" alt="Movie poster">
      </div>
      <div class="movie-info3">
        <div class="movie-title">
            <?php
            $movieId = $_SESSION['movieId'];
            $title_sql = "SELECT * from movie_metadata where movieId='$movieId'";
            $title_resource = mysqli_query($title_sql);
            $title_row = mysqli_fetch_row($title_resource);
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

            $meta_resource = mysqli_query($meta_sql);
            $meta_row = mysqli_fetch_row($meta_resource);
            $genre_resource = mysqli_query($genre_sql);
            $genre_row = mysqli_fetch_row($genre_resource);
            $nation_resource = mysqli_query($nation_sql);
            $nation_row = mysqli_fetch_row($nation_resource);
            $direct_resource = mysqli_query($direct_sql);
            $direct_row = mysqli_fetch_row($direct_resource);

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
      $plot_resource = mysqli_query($plot_sql);
      $plot_row = mysqli_fetch_row($plot_resource);
      echo "<font-size: 15px>",$plot_row[4],"</font>";
      ?>
    </div>

    <div class="comment-recent"><!--movie comments (3) recent-->
        <div class="comment-header">
            <h1>Recent Comments</h1>
                <nav>
                    <span><a href="CommentTyping.php">Type</a></span>
                    <span><a href="ViewComment.html">View</a></span>
                </nav>
        </div>
      <div class="recent"> <!--recent comment-->
        <?php
        $recent_sql = "SELECT reviewTime, comments from review where movieId = 17 order by reviewTime desc LIMIT 3;";

        ?>
      </div>
    </div>

  </main>
  <?php mysqli_close($con); ?>
</body>
</html>