<?php
    session_start();
    include('dbconn.php');

    $movieId = $_SESSION['movieId'];

    $userId = $_SESSION['userId'];
    $date = $_GET['reviewTime'];
    $comment = $_POST['comment'];
    $score = $_POST['score'];

    if ($userId && $comment && $score ){
        $review_edit_sql = "UPDATE review SET rating='$score', comments='$comment', reviewTime=now()
                            WHERE userId='$userId' and reviewTime='$date';";
    }
    mysqli_query($connect, $review_edit_sql);
    header('Location: p_MYPAGE.php');
?>