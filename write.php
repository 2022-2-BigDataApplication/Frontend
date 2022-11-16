<?php
    session_start();
    include('dbconn.php');

    $movieId = $_SESSION['movieId'];

    $userId = $_SESSION['userId'];
    $date = date('YmdHis');
    $comment = $_POST['comment'];
    $score = $_GET['score'];

    $review_add_sql = "INSERT into review (userId, movieId, rating, comments, reviewTime) VAlues ($userId, $movieId, $score, $comment, $date);";
    mysqli_query($connet, $review_add_sql);
    header('Location: p_MainMovie.php');
?>