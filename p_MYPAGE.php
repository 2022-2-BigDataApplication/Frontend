<?php
  include('dbconn.php');
  include 'log_check.php';

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
<h1><a href="p_MAIN.php">New Jelly</a></h1>
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
        <h3><?php echo $user_name ?>'s reviews</h3>
        <div class="array">
          <table>
            <thead>
              <tr>
                <th>Movie</th>
                <th>Date</th>
                <th>Score</th>
                <th>Comments</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($array_row = mysqli_fetch_row($array_resource)){
                  ?>
                  <tr>
                  <td><?php echo $array_row[0]?></td>
                  <td><?php echo $array_row[1]?></td>
                  <td><?php echo $array_row[2]?></td>
                  <td><?php echo $array_row[3]?></td>
                  <td><a href="p_edit.php?reviewTime=<?=$array_row[1]?>">Edit</a></td>
                  <td><a href="delete.php?reviewTime=<?=$array_row[1]?>">Delete</a></form></td>
                  </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
    </div>
</body>
<?php 
mysqli_free_result($array_resource);
mysqli_free_result($review_num_resource);
mysqli_free_result($user_resource);

mysqli_close($connect); 
?>
</html>