<?php
    $conn=mysql_connect( "localhost", "team07", "team07", "team07");
    if(!$conn){
        echo "Database Connection Error";
    }
    else{
        // 커넥션 체크용 나중에 주석처리
        echo "Database Connection Success";
    }
    if(mysqli_connect_errno()){
        echo "Could not connect : ".mysqli_connect_error();
        exit();
    }
?>