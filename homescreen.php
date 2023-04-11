<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
	require 'connect-db.php';

	// function getLeagues() {
	// 	$sql = "SELECT DISTINCT(league) FROM games";
	// 	$stmt = $db->prepare($sql);

	// 	$stmt->execute();
	// 	$leagues = $stmt->fetchAll();
	// 	return $leagues;
	// }

	function numGames($db) {
		$sql = "SELECT league, COUNT(*) AS count FROM games GROUP BY league";
		$stmt = $db->prepare($sql);

		$stmt->execute();
		$leagues = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $leagues;
	}
	$allLeagues = numGames($db);
?>

<body>
<hr>
<h4> Leagues Upon Which to Bet </h4>
<div class="row justify-content-center">
<table class="table table-bordered" style="width:70%">
  <thead>
    <th width="50%">League
    <th width="50%">Number of Games
  </tr>
  </thead>
<?php
	foreach ($allLeagues as $running_variable):
		$league = $running_variable['league'];
?>
		<tr>
			<td><?php echo '<a href="/league.php?league=' . $league . '">' . $league . '</a>'; ?></td>
			<td><?php echo $running_variable['count']; ?></td>
		</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>