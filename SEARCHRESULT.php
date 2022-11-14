<?php include('header.php')?>

<?php
    session_start();
    $conn = mysqli_connect();

    $search = $_GET['search'];
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Users/김해인/Desktop/NewJelly/MAIN.css">
</head>


<body>
    <br><br><br>
    <center>
    <form class="search" action="LIST.php" method=POST">
        
        <h1>Movie Recommender</h1>
    
        <input type="text" name="search_key" placeholder="Enter What You Like">
        <button type="submit" value="search">Search</button>

    </form>
    </center>

    <br><br>
    <hr>
    <br>

    <div class="serchresult">
        <h3>Search Result</h3>
        
        <!--제목포함-->
        <div class="search_title">
            <p>* 제목 포함</p>
            <form action="SEARCHRESULT.php" method="get">
                <?php 
                    $sql1 = "SELECT movieNm, url FROM movie_metadata WHERE movieNm LIKE '%search_key%'";
                    
                ?>
            </form>
        </div>

        <!--배우/감독포함-->
        <div class="search_name">
            <p>* 인물명 포함</p>
            <form action="SEARCHRESULT.php" method="get">
                <?php 
                    $sql1 = "SELECT movieNm, url FROM movie_metadata WHERE movieNm LIKE '%search_key%'";
                    
                ?>
            </form>
        </div> 
        <!--장르포함-->
        <div class="search_genre">
            <p>* 장르 포함</p>
        </div>
</body>
