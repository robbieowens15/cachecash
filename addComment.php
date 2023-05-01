<?php
require 'connect-db.php';

$user = $_SESSION['name'];
$commentVal = $_POST['commentVal'];


function submitComment($db, $user, $comment_val){
    $sql = "INSERT INTO comments (email, comment_value) VALUES((SELECT email FROM accounts WHERE username='$user'), '$comment_val')";
    $db->exec($sql);
}


submitComment($db, $user, $commentVal);
// header('Location: /smacktalk.php?added=yes');
echo '<script>window.location.href = "/smacktalk.php?added=yes";</script>';