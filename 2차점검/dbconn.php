<?
    $connect=mysql_connect( "localhost", "root", "apmsetup", "DBname") or  
        die( "Can't connect to DB server"); 

    mysql_select_db("DBname",$connect);
?>