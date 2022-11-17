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

    mysqli_query($connect, "CREATE TABLE IF NOT EXISTS testreview (testscore int(5) NOT NULL, testcomments text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    mysqli_begin_transaction($connect);

    try {
        mysqli_query($connect, "INSERT INTO testreview(testscore, testcomments) VALUES (5, 'good')");
        
        $test_score = 'non';
        $test_comments = 'bad';
        $stmt = mysqli_prepare($connect, 'INSERT INTO testreview(testscore, testcomments) VALUES (?, ?)');
        mysqli_stmt_bind_param($stmt, 'ss', $test_score, $test_comments);
        mysqli_stmt_execute($stmt);

        mysqli_commit($connect);
    } catch (mysqli_sql_exception $exception) {
        
        mysqli_rollback($mysqli);

        throw $exception;
    }

    mysqli_query($connect, $review_add_sql);
    header('Location: p_MainMovie.php');
?>