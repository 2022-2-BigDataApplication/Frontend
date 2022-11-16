<?php
    include 'log_check.php';
    include 'dbconn.php';
    $sql_genre_year = "SELECT  z.years, 
    MAX(IF(z.genreId = 12, z.cnt, 0)) AS 'Adventure',
    MAX(IF(z.genreId = 14, z.cnt, 0)) AS 'Fantasy',
    MAX(IF(z.genreId = 16, z.cnt, 0)) AS 'Animation',
    MAX(IF(z.genreId = 18, z.cnt, 0)) AS 'Drama',
    MAX(IF(z.genreId = 27, z.cnt, 0)) AS 'Horror',
    MAX(IF(z.genreId = 28, z.cnt, 0)) AS 'Action',
    MAX(IF(z.genreId = 35, z.cnt, 0)) AS 'Comedy',
    MAX(IF(z.genreId = 36, z.cnt, 0)) AS 'History',
    MAX(IF(z.genreId = 37, z.cnt, 0)) AS 'Western',
    MAX(IF(z.genreId = 53, z.cnt, 0)) AS 'Thriller',
    MAX(IF(z.genreId = 80, z.cnt, 0)) AS 'Crime',
    MAX(IF(z.genreId = 99, z.cnt, 0)) AS 'Documentary',
    MAX(IF(z.genreId = 878, z.cnt, 0)) AS 'Science Fiction',
    MAX(IF(z.genreId = 9648, z.cnt, 0)) AS 'Mystery',
    MAX(IF(z.genreId = 10402, z.cnt, 0)) AS 'Music',
    MAX(IF(z.genreId = 10749, z.cnt, 0)) AS 'Romance',
    MAX(IF(z.genreId = 10751, z.cnt, 0)) AS 'Family',
    MAX(IF(z.genreId = 10752, z.cnt, 0)) AS 'War',
    MAX(IF(z.genreId = 10769, z.cnt, 0)) AS 'Foreign',
    MAX(IF(z.genreId = 10770, z.cnt, 0)) AS 'TV Movie'
    FROM     ( select yy.years, g.genreName, g.genreId, yy.cnt
    from (select y.years, y.genreId, count(*) as cnt
    from (select CAST(m.openDt As CHAR(3))*10 as years, m.genreId 
    from movie_metadata m) y 
    group by y.years, y.genreId with rollup) yy
    inner join genre g on g.genreId = yy.genreId
    ) z
    group by z.years
    order by z.years desc;
";
$result_genre_year = mysqli_query($connect, $sql_genre_year);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="headerCSS.css">
</head>

<header>
    <h1>New Jelly</h1>
    <?php
        if($jb_login) {
    ?>
    <nav>
      <span><a href="logout.php">Logout</a></span>
      <span><a href="p_MYPAGE.php">Mypage</a></span>
    </nav>
    <?php
        } else {
    ?>
    <nav>
      <span><a href="p_login.php">Login</a></span>
      <span><a href="p_join.php">Join</a></span>
    </nav>
    <?php } ?>    
</header>

<body>
    <div style="text-align: center; padding-top: 100px;">
        <p style="font-size: 40px; text-align: center; font-weight: bold;">Movie Recommender</p>
        <button type="button" onClick="location.href='p_searchIndex.php'">SEARCH</button>
        <button type="button" onClick="location.href='p_exploreIndex.php'">EXPLORE</button>   
    </div>

    <div class = "genre">
        show movies by genre and time
        <table>
        <tr><td>year</td><td>Adventure</td><td>Fantasy</td><td>Animation</td>
            <td>Drama</td><td>Horror</td><td>Action</td><td>Comedy</td><td>History</td>
            <td>Western</td><td>Thriller</td><td>Crime</td><td>Documentary</td>
            <td>Science Fiction</td><td>Mystery</td><td>Music</td><td>Romance</td><td>Family</td>
            <td>War</td><td>Foreign</td><td>TV Movie</td>
        </tr>
        <?php
        while($row = mysqli_fetch_array($result_genre_year)){
            $year = $row['years'];
            $Adventure = $row['Adventure'];
            $Fantasy = $row['Fantasy'];
            $Animation = $row['Animation']; 
            $Drama = $row['Drama']; 
            $Horror = $row['Horror']; 
            $Action = $row['Action']; 
            $Comedy = $row['Comedy']; 
            $History = $row['History']; 
            $Western = $row['Western']; 
            $Thriller = $row['Thriller'];
            $Crime = $row['Crime']; 
            $Documentary = $row['Documentary']; 
            $Science_Fiction = $row['Science Fiction']; 
            $Mystery = $row['Mystery']; 
            $Music = $row['Music']; 
            $Romance = $row['Romance']; 
            $Family = $row['Family']; 
            $War = $row['War']; 
            $Foreign = $row['Foreign']; 
            $TV_Movie = $row['TV Movie']; 
        
            echo "<tr align=\"center\"><td>$year</td><td>$Adventure</td><td>$Fantasy</td><td>$Animation</td>
            <td>$Drama</td><td>$Horror</td><td>$Action</td><td>$Comedy</td><td>$History</td>
            <td>$Western</td><td>$Thriller</td><td>$Crime</td><td>$Documentary</td>
            <td>$Science_Fiction</td><td>$Mystery</td><td>$Music</td><td>$Romance</td><td>$Family</td>
            <td>$War</td><td>$Foreign</td><td>$TV_Movie</td>
            </tr>";                     
        }
        ?>
        </table>
    </div>
<?php
mysqli_free_result($result_genre_year);
mysqli_close($connect);
?>
</body>
</html>