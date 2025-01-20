<?php
session_start();
session_destroy();

// Hapus cookie
setcookie('user_email', '', time() - 3600, '/');
setcookie('user_token', '', time() - 3600, '/');

header('Location: login.php');
exit();
?>
