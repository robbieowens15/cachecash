<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
include 'navbar.php';
require 'connect-db.php';
$user = $_SESSION['name'];

function getLeaderboard($db) {
    $sql = "SELECT username, balance FROM accounts ORDER BY balance DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $board = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $board;
}

function getFriends($db, $user) {
    $sql = "SELECT username FROM accounts WHERE email IN (SELECT email_2 FROM friends WHERE email_1=(SELECT email from accounts WHERE username='$user'))";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $f = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $f;
}

$leaderboard = getLeaderboard($db);
$friendsAlready = getFriends($db, $user);

if($_GET['added']=="yes"){
    echo '<script>alert("Successfully added friend!")</script>';
}
?>

<body>
<div>&nbsp</div>
<style>
	.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 50%;
  }
</style>
<img style="width: 20%;" src="img/cachecash.png" class="center">
<h4 style="text-align:center;">CacheCash Leaderboard</h4>
<div class="row justify-content-center">
<table class="table table-bordered" style="width:70%">
  <thead>
    <th width="33%">User
    <th width="33%">Balance
    <th width="33%">Add Friend
  </tr>
  </thead>
<?php

	foreach ($leaderboard as $running_variable):
?>
		<tr>
            <td><a href="<?php echo "/cachecash/profile.php?prof=" . $running_variable['username']; ?>"   ><?php echo $running_variable['username']; ?></a></td>
			<td><?php echo $running_variable['balance']; ?></td>
            <td><?php 
            if ($running_variable['username'] != $_SESSION['name']){
                if (!in_array($running_variable['username'], array_column($friendsAlready, "username"))){
                    if (isset($_SESSION['name'])){
                        echo '<a class="btn btn-primary" role="button" href="/cachecash/addFriend.php?prof=' . $running_variable['username'] . '"> Add ' .  $running_variable['username'] . ' as Friend </a>';?></td>
                   <?php 
                    }
                    else{
                        echo "Please log in to add friends";
                    }    
                }
                else{
                    echo "Already friends!";
                } 
                }
                else{
                    echo "You're friends with yourself!";
                }
            ?>
            
		</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>

