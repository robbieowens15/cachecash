<?php
    session_start();
	require 'connect-db.php';
	$prof = $_GET['prof'];
    $user = $_SESSION['name'];

    function addFriend($db, $email1, $email2) {
        $sql = "INSERT INTO friends (email_1, email_2) VALUES ('$email1', '$email2')";
        $db->exec($sql);
    }

    function getEmailOfUser1($db, $user){
        $sql = "SELECT email FROM accounts WHERE username='$user'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $email1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $email1;
    }

    function getEmailOfUser2($db, $prof){
        $sql = "SELECT email FROM accounts WHERE username='$prof'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $email2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $email2;
    }
$email1 = getEmailOfUser1($db, $user);
$email2 = getEmailOfUser2($db, $prof);
addFriend($db, $email1[0]['email'], $email2[0]['email']);
echo '<script>window.location.href = "/leaderboard.php?added=yes";</script>'
?>