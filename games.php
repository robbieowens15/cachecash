<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
include 'connect-db.php';
include 'navbar.php';
require 'connect-db.php';

function getBets($db, $user) {
    $sql = "SELECT username FROM accounts WHERE email IN (SELECT email_2 FROM friends WHERE email_1=(SELECT email from accounts WHERE username='$user'))";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $f = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $f;
}
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
						<div class="card-bodyyy">
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
											<th>Away Team Spread</th>
											<th>Over/Under</th>
											<th>Home Moneyline</th>
											<th>Away Moneyline</th>
											<th>Date</th>
											<th>Bet Type</th>
											<th>Wager ($)</th>
											<th>Status</th>
											<th>P/L ($)</th>
										</tr>
									</thead>
									<tbody>
									<?php
											// $con = mysqli_connect("localhost:3306","root","Wahoos4750","CacheCash");
											if(isset($_GET['from_date']) && isset($_GET['to_date']))
											{
												$from_date = $_GET['from_date'];
												$to_date = $_GET['to_date'];
	
											}
											else {
												$first_game_sql = "SELECT * FROM games ORDER BY game_date LIMIT 1";
												$stmt = $db->prepare($first_game_sql);
												$stmt->execute();
												$from_date = $stmt->fetch(PDO::FETCH_ASSOC)['game_date'];

												$last_game_sql = "SELECT * FROM games ORDER BY game_date DESC LIMIT 1";
												$stmt2 = $db->prepare($last_game_sql);
												$stmt2->execute();
												$to_date = $stmt2->fetch(PDO::FETCH_ASSOC)['game_date'];
											}

												// $query = "SELECT * FROM games WHERE game_date BETWEEN '$from_date' AND '$to_date'";
												// $query_run = mysqli_query($con, $query);
												$sql = "SELECT * FROM games WHERE game_date BETWEEN '$from_date' AND '$to_date' ORDER BY game_date";
												$stmt = $db->prepare($sql);
												$stmt->execute();
												$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
												if($stmt->rowCount() > 0)
												{
													foreach($games as $row):?>
														<tr>
															<td><?= $row['league']; ?></td>
															<td><?= $row['home_team']; ?></td>
															<td><?= $row['away_team']; ?></td>
															<td><?= $row['homeSpread']; ?></td>
															<td><?= $row['awaySpread']; ?></td>
															<td><?= $row['over_under']; ?></td>
															<td><?= $row['homeMoneyline']; ?></td>
															<td><?= $row['awayMoneyline']; ?></td>
															<td><?= $row['game_date']; ?></td>

															<!-- TODO: conditional to get existing bet -->
															<!-- Format with existing bet -->

															<!-- If pending -->
															<!-- 
															<td>Over</td>
															<td>9</td>
															<td>wagered</td>
															<td> ? </td> -->
															<!-- If bet is resolved -->
															<!--
															<td>Under</td> 
															<td>9</td>
															<td>won or lost</td>
															<td> some_$ </td> -->

															<!-- Form to Create a bet / Display a bet starts here -->
															<form action="place-bet.php" method="POST">
																<td>
																<div class="form-group">
																<select class="form-control" name="selectedOption" id="selectedOption" required style="width:200px;">
																	<option value="">Select a league</option>
																	<option value="Home Moneyline">Home Moneyline</option>
																	<option value="Home Spread">Home Spread</option>
																	<option value="Away Moneyline">Away Moneyline</option>
																	<option value="Away Spread">Away Spread</option>
																	<option value="Over">Over</option>
																	<option value="Under">Under</option>
																</select>
																</div>
													</td>

																<td>
																	<div class="form-group">
																		<input type="number" step="1.00" class="form-control" id="floatingInput" name="wager_amount" placeholder="0.00" required style="width: 100px;">
																	</div>
																</td>

																<td>
																	<input type="submit" class="btn btn-primary"/>
																</td>
																
																<!-- Pass to form processing (place-bet.php), but do not take input! -->
																<input type="hidden" name="game_id" value="<?=  $row['game_id'] ?>" />
														
														</form> 
														
														<td> NA </td>
														<!-- ENDS HERE -->
														</tr>
													<?php
													endforeach;
												}
												else
												{
													echo "No Record Found";
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