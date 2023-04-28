<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<?php
include 'navbar.php';
require 'connect-db.php';
$user = $_SESSION['name'];

if($_GET['added']=="yes"){
    echo '<script>alert("Successfully added game!")</script>';
}

function checkAdmin($db, $user){
        $sql = "SELECT admin FROM accounts WHERE username='$user'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $admin;
}

$admin = checkAdmin($db, $user);
if (intval($admin[0]['admin'] != 1)){
    echo '<script>alert("You do not have admin access"); window.location.href = "/cachecash/homescreen.php";</script>';
    exit;
}

?>

<html>
<head>
	<title>Admin Page</title>
</head><body>
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
<div class="container w-50 mt-5">
		<h1>Admin Page - Add Game</h1>
		<form method="post" action="addGame.php">
    
        <div class="form-group">
        <label for="league">League</label>
        <select class="form-control w-25" name="league" id="league" required>
            <option value="">Select a league</option>
            <option value="NBA">NBA</option>
            <option value="MLB">MLB</option>
            <option value="CBB">CBB</option>
            <option value="NHL">NHL</option>
        </select>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="homeTeam">Home Team Name</label>
            <input class="form-control w-75" name="homeTeam" id="homeTeam" required>
        </div>
        <div class="col">
            <label for="homeMoneyline">Home Moneyline:</label>
            <input type="number" class="form-control w-50" name="homeMoneyline" step="any" id="homeMoneyline" required>
        </div>
        <div class="col">
            <label for="homeSpread">Home Spread:</label>
            <input type="number" class="form-control w-50" name="homeSpread" step="any" id="homeSpread" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="awayTeam">Away Team Name</label>
            <input class="form-control w-75" name="awayTeam" id="awayTeam" required>
        </div>
        <div class="col">
            <label for="awayMoneyline">Away Moneyline:</label>
            <input type="number" class="form-control w-50" name="awayMoneyline" id="awayMoneyline" required>
        </div>
        <div class="col">
            <label for="awaySpread">Away Spread:</label>
            <input type="number" class="form-control w-50" name="awaySpread" step="any" id="awaySpread" required>
        </div>
    </div>

    <div class="form-group">
            <label for="overUnder">Over / Under:</label>
            <input type="number" class="form-control w-25" name="overUnder" step="any" id="overUnder" required>
        </div>

    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control w-25" name="date" id="date" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


	</div>
</body>
</html>