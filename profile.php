<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
require 'connect-db.php';

if(!isset($_SESSION['name'])){
    echo '<script>alert("Please log in to access"); window.location.href = "/";</script>';
}



if(isset($_GET['prof'])){
    $user = $_GET['prof']; 
}
else{
    $user = $_SESSION['name'];
}



function getUserInfo($db, $user) {
    $sql = "SELECT username, email, balance, age FROM accounts WHERE username='$user'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $userInfo;
}

function getFriends($db, $user) {
    $sql = "SELECT username, email FROM accounts WHERE email IN (SELECT email_2 FROM friends WHERE email_1=(SELECT email from accounts WHERE username='$user'))";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $userInfo;
}

function getBets($db, $user) {
    $sql = "SELECT team, wager, bet_type, active, result FROM bets WHERE account_id=(SELECT id from accounts WHERE username='$user')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $bets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $bets;
}

$profile = getUserInfo($db, $user);
$friends = getFriends($db, $user);
$bets = getBets($db, $user);


?>

<head>
	<link rel="stylesheet" href="css/styles.css" type=text/css>
</head>
<img style="width: 20%;" src="img/cachecash.png" class="center">

<div class="container d-flex justify-content-center mt-5">

	<div class="card-profile">

		<div class="top-container">

			<div class="ml-3">
            <?php
            foreach ($profile as $running_variable):
            ?>
				<h5 class="name"><?php echo $running_variable['username']; ?></h5>
				<p class="mail">Email: <?php echo $running_variable['email']; ?></p>
                <p class="mail"> Age: <?php echo $running_variable['age']; ?></p>
			</div>
            <?php endforeach; ?>
		</div>

		<div class="middle-container d-flex justify-content-between align-items-center mt-3 p-2">
				<div class="dollar-div px-3">


				</div>
				<div class="d-flex flex-column text-right mr-2">
					<span class="current-balance">Current Balance</span>
					<span class="amount"><span class="dollar-sign">$</span><?php echo $running_variable['balance']; ?></span>
                </div>
		</div>
        <div class="recent-border mt-4" style="display: flex; flex-direction: column;">
		<div class="recent-border mt-4">
            <button class="recent-orders" onclick="toggleTable()">Friends &#9660;</button>
		</div>
        <table id="friends" class="table table-bordered" style="display: none;">
        <thead>
            <th width="50%">Username
            <th width="50%">Email
        </tr>
        </thead>
        <?php
	    foreach ($friends as $running_variable):
        ?>
		<tr>
        <td><?php echo $running_variable['username']; ?></td> <td><?php echo $running_variable['email']; ?></td> 

		</tr>
<?php endforeach; ?>
        
<div class="recent-border mt-4">
                    <button id="bets" class="recent-orders" onclick="toggleTableBets()">Bets &#9660;</button>
                </div>
                <table id="betsTable" class="table table-bordered" style="display: none;">
                <thead>
                    <th width="20%">Team
                    <th width="20%">Wager
                    <th width="20%">Amount
                    <th width="20%">Active
                    <th width="20%">Result
                </tr>
                </thead>
                <?php
                foreach ($bets as $running_variable2):
                ?>
                <tr>
                <td><?php echo $running_variable2['team']; ?></td> 
                <td><?php echo $running_variable2['wager']; ?></td> 
                <td><?php echo $running_variable2['bet_type']; ?></td> 
                <td><?php echo $running_variable2['active']; ?></td> 
                <td><?php echo $running_variable2['result']; ?></td> 

                </tr>
<?php endforeach; ?>
	</div>
</div>

<script>
function toggleTable() {
  var table = document.getElementById("friends");
  if (table.style.display === "none") {
    table.style.display = "table";
    var betsButton = document.getElementById("bets").parentNode;
    betsButton.parentNode.insertBefore(table, betsButton);
  } else {
    table.style.display = "none";
  }
}

  function toggleTableBets() {
    var table = document.getElementById("betsTable");
    if (table.style.display === "none") {
      table.style.display = "table";
    } else {
      table.style.display = "none";
    }
  }
</script>
</div>
