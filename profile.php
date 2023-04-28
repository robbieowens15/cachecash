<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
include 'navbar.php';
require 'connect-db.php';

$user = $_SESSION['name'];
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

$profile = getUserInfo($db, $user);
$friends = getFriends($db, $user);
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

		<div class="recent-border mt-4">
			<span class="recent-orders">Friends</span>
		</div>
        <table class="table table-bordered" style="width:100%">
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
	</div>
</div>

