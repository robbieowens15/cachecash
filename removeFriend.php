<?php
session_start();
require 'connect-db.php';
$email1 = $_POST['email1'];
$email2= $_POST['email2'];

echo $email2;

function remove($db, $email1, $email2){
    $sql="DELETE FROM friends WHERE email_1 = '$email1' AND email_2 = '$email2'";
	echo $sql;
    $db->exec($sql);
}

remove($db, $email1, $email2);
// header('Location: /admin.php?deleted=yes');
echo '<script>window.location.href = "/profile.php?deleted=yes";</script>';
?>