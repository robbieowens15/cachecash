<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
	require 'connect-db.php';
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
<hr>
<h4> <?php echo $league . " Games" ?> </h4>
<div class="row justify-content-center">
<table class="table table-bordered" style="width:70%">
  <thead>
    <th width="20%">Home Team
    <th width="20%">Away Team
	<th width="20%">Home Team Spread
    <th width="20%">Over/Under
	<th width="20%">Home Moneyline
  </tr>
  </thead>
<?php foreach ($leagueGames as $running_variable): ?>
  <tr>
     <td><?php echo $running_variable['home_team']; ?></td>
	 <td><?php echo $running_variable['away_team']; ?></td>
	 <td><?php echo $running_variable['homeSpread']; ?></td>
	 <td><?php echo $running_variable['over_under']; ?></td>
	 <td><?php echo $running_variable['homeMoneyline']; ?></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>