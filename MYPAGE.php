<?php
    session_start();
    $user_id = isset($_SESSION["id"])? $_SESSION["id"]:"";
    $user_name = isset($_SESSION["username"])? $_SESSION["username"]:"";
    
    $sql1 = "SELECT * FROM review WHERE userId=$user_id";
    $sql2 = "SELECT count(*) FROM review WHERE userId =$user_id";
    
    

    /*sql1 결과로 나온 거 count 해서 따로 변수로 두기  */

?>


<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
  </head>
    <!--자기소개-->
    <div>
      <h1>Hello, <?php echo $user_name?>!</h1>
      <p><?php echo  $intro?></p>
    </div>

    <hr>
    <!--영화수-->
    <div>
      <p># of movies that <?php echo $user_name?> scored: <?php ?></p>
    </div>

    <hr>
    <!--영화 리뷰-->
    <div>
      <?php while($movies = $sql->mysqli_fetch_array()) {
                
                $movie_id = $movies["movie_id"];
                ?> 

                <article><img src=<?php echo $movies["url"] ?>></article>

                <?php
            }
      ?>
    </div>
  <body>
    

  </body>
</html>
