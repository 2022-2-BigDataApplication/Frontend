<?php
  session_start();
  include('dbconn.php');
  $user_sql = "SELECT * FROM users WHERE userID = $userId"
  $review_sql = "SELECT * FROM review WHERE userId=$userId";
  $reviewcount_sql = "SELECT count(*) FROM review WHERE userId =$userId";

  $user_resource = mysql_query($user_sql);
  $user_row = mysql_fetch_row($user_resource);
  $user_name = $user_row[2];
  $user_intro = $user_row[3];

  $review_num_resource = mysql_query($reviewcount_sql);
  $review_num = mysql_fetch_row($review_num_resource);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mypage.css">
</head>
<header>
    <h1>New Jelly</h1>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="mypage.php">Mypage</a></span>
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
        The number <?php echo $user_name ?> reviewed: <?php echo $review_num ?>
    </div>

    <?php
      $array_sql = "SELECT * from review where userId = $userId"
      $array_resource = mysql_query($array_sql);
    ?>
    
    <div class="reviews">
        <h3><?php echo $user_name ?>'s reviews</h3>
        <div class="array">
          <table>
            <thead>
              <tr>
                <th>Movie</th><th>Date</th><th>Score</th><th>Comments</th><th>Edit</th><th>Delete</th>
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
    </div>
</body>
</html>