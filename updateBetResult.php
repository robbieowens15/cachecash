<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<?php
require 'connect-db.php';




$bet_num = intval($_POST['bet_num']);
$game_id = $_POST['game_id'];
$result= $_POST['selectedOption'];

function update($db, $bet_num, $result){
    $sql="UPDATE bets SET result='$result' WHERE bet_num = $bet_num";
    $db->exec($sql);

    $sql="UPDATE bets SET active=0 WHERE bet_num = $bet_num";
    $db->exec($sql);
}

update($db, $bet_num, $result);
header('Location: /cachecash/admin.php?updated=yes');
?>