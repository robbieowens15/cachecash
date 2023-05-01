<?php
session_start();
session_destroy();
// Redirect to the login page:
// header('Location: /');
echo '<script>window.location.href = "/";</script>';
?>