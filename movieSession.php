<?php
    session_start();
    include 'dbconn.php';
    $movieId_sql = "SELECT movieId from movie_metadata where posterPath = '".$_SESSION["pathKey"]."'";
    $movieId = mysqli_query($connect, $movieId_sql);
    $_SESSION['movieId'] = $movieId;
    echo("
    <script>
    location.href='p_MainMovie.php';
    </script>
    ");
    mysqli_close($connect);
?>