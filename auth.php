<?php
// ob_start();
session_start();
require 'connect-db.php';

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}

$user = $_POST['username'];

function checkUserExists($db, $user){
    $sql = "SELECT COUNT(username) as c FROM accounts WHERE username='$user'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $iunno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $iunno;
}

if (checkUserExists($db, $user)[0]['c'] == "0"){
    echo '<script>alert("That username does not exist"); window.location.href = "/login.php";</script>';
}

function checkPassword($db, $user) {

    $sql = "SELECT id, password FROM accounts WHERE username='$user'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $iunno = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $iunno;
}

$passwords = checkPassword($db, $user);

foreach ($passwords as $running_variable):
    if (password_verify($_POST['password'], $running_variable['password'])){
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        header("Location: /");
    }
    else{
        echo '<script>alert("Incorrect password"); window.location.href = "/login.php";</script>';
    }
endforeach; ?>