<?php
    session_start();
    include('dbconn.php');

    $userId = $_SESSION['userId'];
    $date = $_GET['reviewTime'];

    if ($userId && $date){
        $review_delete_sql = "DELETE from review WHERE userId='$userId' and reviewTime='$date';";
    }

    mysqli_query($connect, $review_delete_sql);
    header('Location: p_MYPAGE.php');
?>