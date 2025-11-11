<?php
// auth/logout.php
session_start();
$_SESSION = [];
session_destroy();
header('Location: /Motorkai_final/index.php');
exit;
