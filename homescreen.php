<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
	require 'connect-db.php';
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
<h4 style="text-align:center;">Leagues to Bet On</h4>
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
<style>
	footer {
        position: absolute;
        bottom: 0;
        height: 50px; /* adjust as needed */
        background-color: #f2f2f2;
        width: 100%;
        text-align: center;
      }
	</style>
<footer>
<a href="/admin.php">Admin Page</a>
</footer>
</html>