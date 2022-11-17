<?php
    session_start();
    include 'dbconn.php';
    $movieId_sql = "SELECT movieId from movie_metadata where originalTitle = '".$_POST['pathKey']."';";
    $movieId_resoure = mysqli_query($connect, $movieId_sql);
    $movieId = mysqli_fetch_row($movieId_resoure);

    //echo $movieId[0];

    if(isset($_SESSION['movieId'])){
        unset($_SESSION['movieId']);
        $_SESSION['movieId'] = $movieId[0];
    } else{
        $_SESSION['movieId'] = $movieId[0];
    }

    //echo $_SESSION['movieId'];

    echo("
    <script>
    location.href='p_MainMovie.php';
    </script>
   ");
    mysqli_free_result($movieId_resoure);
    mysqli_close($connect);
?>