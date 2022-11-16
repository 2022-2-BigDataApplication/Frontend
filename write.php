<?php
    session_start();
    include('dbconn.php');

    $movieId = $_SESSION['movieId'];

    $userId = $_SESSION['userId'];
    $date = date('Y-m-d H:i:m');
    $comment = $_POST['comment'];
    $score = $_POST['score'];

    if ($userId && $comment && $score ){
        $review_add_sql = "INSERT into review(userId, movieId, rating, comments, reviewTime) VAlues ('".$userId."', '".$movieId."', '".$score."', '".$comment."', '".$date."');";
    }
    mysqli_query($connect, $review_add_sql);
    header('Location: p_MainMovie.php');
?>