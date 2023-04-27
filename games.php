<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
include 'connect-db.php';
include 'navbar.php';
require 'connect-db.php'
?>
<style>
	.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 50%;
  }
</style>
<img style="width: 20%;" src="img/cachecash.png" class="center">
<body>
	<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card mt-5">
						<div class="card-header">
							<h4>View Games by Date</h4>
						</div>
						<div class="card-body">
							<form action="" method="GET">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>From Date</label>
											<input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>To Date</label>
											<input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Click to Filter</label> <br>
											<button type="submit" class="btn btn-primary">Filter</button>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="card mt-4">
							<div class="card-body">
								<table class="table table-borderd">
									<thead>
										<tr>
											<th>League</th>
											<th>Home Team</th>
											<th>Away Team</th>
											<th>Home Team Spread</th>
											<th>Over/Under</th>
											<th>Home Moneyline</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
										<?php
											// $con = mysqli_connect("localhost:3306","root","Wahoos4750","CacheCash");
											if(isset($_GET['from_date']) && isset($_GET['to_date']))
											{
												$from_date = $_GET['from_date'];
												$to_date = $_GET['to_date'];

												// $query = "SELECT * FROM games WHERE game_date BETWEEN '$from_date' AND '$to_date'";
												// $query_run = mysqli_query($con, $query);
												$sql = "SELECT * FROM games WHERE game_date BETWEEN '$from_date' AND '$to_date' ORDER BY game_date";
												$stmt = $db->prepare($sql);
												$stmt->execute();
												$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
												echo $games;
												if($stmt->rowCount() > 0)
												{
													foreach($games as $row):?>
														<tr>
															<td><?= $row['league']; ?></td>
															<td><?= $row['home_team']; ?></td>
															<td><?= $row['away_team']; ?></td>
															<td><?= $row['homeSpread']; ?></td>
															<td><?= $row['over_under']; ?></td>
															<td><?= $row['homeMoneyline']; ?></td>
															<td><?= $row['game_date']; ?></td>
														</tr>
													<?php
													endforeach;
												}
												else
												{
													echo "No Record Found";
												}
											}
													?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>