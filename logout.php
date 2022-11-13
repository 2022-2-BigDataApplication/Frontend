<?php
session_start();
unset($_SESSION['userid']);
unset($_SESSION['username']);
unset($_SESSION['userIntro']);

echo("
<script>
location.href='MAIN.php';
</script>
");
?>