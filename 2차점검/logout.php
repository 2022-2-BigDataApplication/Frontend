<?php
session_start();
unset($_SESSION['userid']);

echo("
<script>
location.href='MAIN.php';
</script>
");
?>