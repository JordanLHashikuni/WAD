<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Auth/signin.html");
exit;
?>
