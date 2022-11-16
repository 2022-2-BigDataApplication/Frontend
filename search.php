<?php
    include ('dbconn.php');
    $key = $_GET['search_key'];

    $title_sql = 'SELECT originalTitle, posterPath FROM movie_metadata WHERE originalTitle LIKE '$key';';
    $actor_sql = 'SELECT cma.movieId, cma.posterPath, cma.characterName
    from (SELECT  c.movieId, m.posterPath, c.characterName, a.actorName from characters c 
    inner join movie_metadata m on c.movieId = m.movieId
    inner join actor a on c.actorId = a.actorId) cma
    where cma.actorName ='$key';';
    $direct_sql = 'SELECT originalTitle, posterPath from movie_metadata 
    where directorId = (SELECT directorId FROM director WHERE directorName = '$key');';
    $key_sql = 'SELECT originalTitle, posterPath from movie_metadata
    where movieId in (select movieId from describes 
    where keywordId = (select keywordId from keyword where keywordName = '$key')) ;';


?>