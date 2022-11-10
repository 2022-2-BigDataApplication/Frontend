
<?php
  $username = $_POST[ 'id' ];
  $password = $_POST[ 'password' ];
  $password_confirm = $_POST[ 'password_confirm' ];
  if ( !is_null( $username ) ) {
    $jb_conn = mysqli_connect( 'localhost', 'codingfactory', '1234qwer', 'codingfactory.net_example' );
    $jb_sql = "SELECT username FROM user WHERE username = '$username';";
    $jb_result = mysqli_query( $jb_conn, $jb_sql );
    while ( $jb_row = mysqli_fetch_array( $jb_result ) ) {
      $username_e = $jb_row[ 'id' ];
    }
    if ( $username == $username_e ) {
      $wu = 1;
    } elseif ( $password != $password_confirm ) {
      $wp = 1;
    } else {
      $encrypted_password = password_hash( $password, PASSWORD_DEFAULT);
      $jb_sql_add_user = "INSERT INTO user ( id, password ) VALUES ( '$username', '$encrypted_password' );";
      mysqli_query( $jb_conn, $jb_sql_add_user );
      header( 'Location: SIGNUP_OK.php' );
    }
  }
?>
<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>JOIN US!</title>
    <style>
      body { font-family: sans-serif; font-size: 14px; }
      input, button { font-family: inherit; font-size: inherit; }
    </style>
  </head>
  <body>
    <h1>JOIN US!</h1>
    <form action="SIGNUP.php" method="POST">
      <p><input type="text" name="id" placeholder="ID" required></p>
      <p><input type="password" name="password" placeholder="PW" required></p>
      <p><input type="password" name="password_confirm" placeholder="PW CHECK" required></p>
      <p><input type="text" name="name" placeholder="Name" required></p>
      <p><input type="text" name="introduction" placeholder="Introduction" required></p>
      <p><input type="submit" value="회원 가입"></p>
      <?php
        if ( $wu == 1 ) {
          echo "<p>사용자이름이 중복되었습니다.</p>";
        }
        if ( $wp == 1 ) {
          echo "<p>비밀번호가 일치하지 않습니다.</p>";
        }
      ?>
    </form>
  </body>
</html>