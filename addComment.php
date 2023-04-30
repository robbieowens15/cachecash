<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<?php
include 'navbar.php';
require 'connect-db.php';

$user = $_SESSION['name'];
$commentVal = $_POST['commentVal'];


function submitComment($db, $user, $comment_val){
    $sql = "INSERT INTO comments (email, comment_value) VALUES((SELECT email FROM accounts WHERE username='$user'), '$comment_val')";
    echo $sql;
    $db->exec($sql);
}


submitComment($db, $user, $commentVal);
header('Location: /cachecash/smacktalk.php?added=yes');