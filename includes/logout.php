<?php
session_start();
session_destroy();

$loginPath = '../index.php';
header('Location: '.$loginPath);
