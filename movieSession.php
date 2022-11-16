<?php
    session_start();
    include 'dbconn.php';
    $movieId_sql = "SELECT movieId from movie_metadata where posterPath = '".$_SESSION['poster']."'";
    $movieId_resoure = mysqli_query($connect, $movieId_sql);
    $movieId = mysqli_fetch_row($movieId_resoure);
    $_SESSION['movieId'] = $movieId[0];

    echo("
    <script>
    location.href='p_MainMovie.php';
    </script>
    ");
    mysqli_close($connect);
?>