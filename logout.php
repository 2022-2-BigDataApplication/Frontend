<?php
session_start();
unset($_SESSION['userId']);

echo("
<script>
location.href='p_MAIN.php';
</script>
");
?>