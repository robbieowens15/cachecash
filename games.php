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
												echo $games;
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
																		<div class="dropdown">
																			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				Select an option
																			</button>
																			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																			<a class="dropdown-item" href="#" data-value="Option 1" onclick="setDropdownText(this)">Option 1
																				<select style="display:none;">
																					<option>Home Spread</option>
																				</select>
																			</a>
																			<a class="dropdown-item" href="#" data-value="Option 2" onclick="setDropdownText(this)">Option 2
																				<select style="display:none;">
																					<option>Away Spread</option>
																				</select>
																			</a>
																			<a class="dropdown-item" href="#" data-value="Option 3" onclick="setDropdownText(this)">Option 3
																				<select style="display:none;">
																					<option>Home Moneyline</option>
																				</select>
																			</a>
																			<a class="dropdown-item" href="#" data-value="Option 4" onclick="setDropdownText(this)">Option 4
																				<select style="display:none;">
																					<option>Away Moneyline</option>
																				</select>
																			</a>
																			<a class="dropdown-item" href="#" data-value="Option 5" onclick="setDropdownText(this)">Option 5
																				<select style="display:none;">
																					<option>Over</option>
																				</select>
																			</a>
																			<a class="dropdown-item" href="#" data-value="Option 6" onclick="setDropdownText(this)">Option 6
																				<select style="display:none;">
																					<option>Under</option>
																				</select>
																			</a>
																			</div>
																		</div>
																		<input type="hidden" name="selectedOption" id="selectedOption" required>
																	</div>

																	<script>
																		function setDropdownText(el) {
																			var text = el.getAttribute("data-value");
																			document.getElementById("dropdownMenuButton").innerText = text;
																			document.getElementById("selectedOption").value = text;
																		}
																	</script>
																</td>

																<td>
																	<div class="form-group">
																		<input type="number" step="1.00" class="form-control" id="floatingInput" name="wager_amount" placeholder="0.00" required style="width: 100px;">
																	</div>
																</td>
																<td>
																	<input type="submit" name="place" value="Place Bet" class="btn btn-primary" />
																</td>
																<td> - </td>
															</form>
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