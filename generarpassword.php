<?php
$pass = 'admin123';
$hash = password_hash($pass, PASSWORD_BCRYPT);
echo $hash;
?>