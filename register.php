<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
require 'connect-db.php';

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['age'])) {
    echo '<script>alert("Please fill out the entire registration form"); window.location.href = "/";</script>';
}


$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$em = $_POST['email'];
$age = $_POST['age'];

function checkUserExists($db, $user) {

    $sql = "SELECT id, username FROM accounts WHERE username='$user'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $iunno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $iunno;
}
$userCheck = checkUserExists($db, $user);


function createNewUser($db, $user, $pass, $em, $age) {
    $sql = "INSERT INTO accounts (username, password, email, age) VALUES ('$user', '$pass', '$em', $age)";
    $db->exec($sql);
}

foreach ($userCheck as $running_variable):
    if ($running_variable['username'] == $_POST['username']){
        echo '<script>alert("That username already exists"); window.location.href = "/login.php";</script>';
        exit;
    }
endforeach;


createNewUser($db, $user, $pass, $em, $age);
// header('Location: /login.php?created=yes');
echo '<script>window.location.href = "/login.php?created=yes";</script>';
?>
