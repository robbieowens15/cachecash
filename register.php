<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
require 'connect-db.php';
include 'navbar.php';

if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['age'])) {
	exit('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['age'])) {
	exit('Please complete the registration form');
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

$bad = False;
foreach ($userCheck as $running_variable): 
    if ($running_variable['username'] == $_POST['username']){
        echo 'Username already exists.';
        $bad = True;
    ?>
    <a class="btn btn-primary" href="/cachecash/login.php" role="button">Back to Register</a>
    <?php
    }
endforeach; 

if (!$bad){
    createNewUser($db, $user, $pass, $em, $age); 
    ?>
    <a class="btn btn-primary" href="/cachecash/homescreen.php" role="button">Back to Home to Login</a>
    <?php
}
?>
