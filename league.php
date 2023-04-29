<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
	require 'connect-db.php';
	include 'navbar.php';
	$league = $_GET['league'];

	function getGames($db, $league) {
		$sql = "SELECT * FROM games WHERE league = '$league'";
		$stmt = $db->prepare($sql);

		$stmt->execute();
		$leagues = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $leagues;
	}
	$leagueGames = getGames($db, $league);
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
<h4 style="text-align:center;"> <?php echo $league . " Games" ?> </h4>
<div class="row justify-content-center">
<table class="table table-bordered" style="width:85%">
  <thead>
    <th width="16%">Home Team
    <th width="16%">Away Team
	<th width="10%">Home Team Spread
	<th width="10%">Away Team Spread
    <th width="10%">Over/Under
	<th width="10%">Home Moneyline
	<th width="10%">Away Moneyline
	<th width="30%" >Bet
  </tr>
  </thead>
<?php foreach ($leagueGames as $running_variable): ?>
  <tr>
     <td><?php echo $running_variable['home_team']; ?></td>
	 <td><?php echo $running_variable['away_team']; ?></td>
	 <td><?php echo $running_variable['homeSpread']; ?></td>
	 <td><?php echo $running_variable['awaySpread']; ?></td>
	 <td><?php echo $running_variable['over_under']; ?></td>
	 <td><?php echo $running_variable['homeMoneyline']; ?></td>
	 <td><?php echo $running_variable['awayMoneyline']; ?></td>
	 <td><a class="btn btn-primary" href="/cachecash/games.php" role="button">Bet on this Game</a>
  </tr>
<?php endforeach; ?>
</table>
</div>
<div class="row justify-content-center">
<a class="btn btn-primary" href="/cachecash/homescreen.php" role="button">Back to Home</a>
</div>
</body>
</html>