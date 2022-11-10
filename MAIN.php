
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Users/김해인/Desktop/NewJelly/Frontend/MAIN/MAIN.css">

</head>

<?php
    session_start();
    $user_id = isset($_SESSION["id"])? $_SESSION["id"]:"";
    $user_name = isset($_SESSION["username"])? $_SESSION["username"]:"";
?>

<body>

    <!--로그인 전-->
    <?php if (!$user_id) { ?>
    <!-- 상단바에 로그인, 회원가입 -->
    <div class="header">
        <h1>Movie Recommender</h1>
    </div>
           
    <br><br><br><br>
    
    <center>
    <button type="button" class="myButton" onClick="location.href=#">SEARCH</button>
    <button type="button" class="myButton" onClick="location.href=#">EXPLORE</button>
    </center>

    <br><br><br><br>
    <!--로그인 후-->
    <?php } else { ?>

        <div class="header">
        <h1>Movie Recommender</h1>
    </div>
           
    <br><br><br><br>
    
    <center>
    <button type="button" class="myButton" onClick="SEARCHRESULT.html'">SEARCH</button>
    <button type="button" class="myButton" onClick="EXPLORE.html'">EXPLORE</button>
    </center>

    <br><br><br><br>

    <?php }; ?>
    


</body>
