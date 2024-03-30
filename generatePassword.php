<?php

$password = 'admin';

$pwdEncrypted = password_hash($password, PASSWORD_DEFAULT);

echo $pwdEncrypted;

echo (password_verify($password, $pwdEncrypted) ? "\n" . 'Password encrypted and verified successfully' : "\n" . "Password error");
?>
