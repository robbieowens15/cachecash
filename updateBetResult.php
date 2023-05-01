<?php
require 'connect-db.php';
$bet_num = intval($_POST['bet_num']);
$game_id = $_POST['game_id'];
$result= $_POST['selectedOption'];

function update($db, $bet_num, $result){
    $sql="UPDATE bets SET result='$result', active=0 WHERE bet_num = $bet_num";
    $db->exec($sql);
}

update($db, $bet_num, $result);
// header('Location: /admin.php?updated=yes');
echo '<script>window.location.href = "/admin.php?updated=yes";</script>';
?>