dd<?php
  include('dbconn.php');

  $userId = $_SESSION['userId'];
  $user_sql = "SELECT * FROM users WHERE userID = '$userId'";
  $reviewcount_sql = "SELECT count(*) FROM review WHERE userId ='$userId'";

  $user_resource = mysqli_query($connect, $user_sql);
  $user_row = mysqli_fetch_row($user_resource);
  $user_name = $user_row[2];
  $user_intro = $user_row[3];

  $review_num_resource = mysqli_query($connect, $reviewcount_sql);
  $review_num = mysqli_fetch_row($review_num_resource);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mypage.css">
</head>
<header>
    <h1><a href="p_MAIN.php" style="color:white; text-decoration: none;">New Jelly</a></h1>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="p_MYPAGE.php">Mypage</a></span>
    </nav>
</header>

<body>
    <div class="MYPAGE">
        <div class="about">
            <p><?php echo $user_name ?>'S MY PAGE</p>
        </div>

        <div class="introduction">
            <p>Hello, My name is <?php echo $user_name ?></p>
            <p><?php echo $user_intro ?></p>
        </div>
    </div>

    <div class="count">
        The number <?php echo $user_name ?> reviewed: <?php echo $review_num[0] ?>
    </div>

    <?php
      $array_sql = "SELECT m.originalTitle, review.reviewTime, review.rating, review.comments from review as review
      INNER JOIN movie_metadata as m on review.movieId = m.movieId
      WHERE userId= '$userId';";
      $array_resource = mysqli_query($connect, $array_sql);
    ?>
    
    <div class="reviews">
        <h3>Editing</h3>
        <?php
        $userId = $_SESSION['userId'];
        $date = $_GET['reviewTime'];
        ?>

        <form action="edit.php?reviewTime=<?=$date?>" method = "post">
          <textarea class="comment-area" maxlength="500" name = "comment" placeholder="comment area" required>
          </textarea> <br>
          <select name="score">
            <option>review score</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select> <br>
          <input type="submit" name="submit" size="50" value="Done" style="height:30px; width:50px; background-color: green; border: 0px; color: white; font-weight: bold; margin-top: 10px;"/>
        </form>
    </div>
</body>
<?php 
mysqli_free_result($array_resource);
mysqli_free_result($review_num_resource);
mysqli_free_result($user_resource);

mysqli_close($connect); 
?>
</html>
