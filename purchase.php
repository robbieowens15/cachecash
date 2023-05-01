<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
include 'connect-db.php';

if(!isset($_SESSION['name'])){
    echo '<script>alert("Please log in to access"); window.location.href = "/homescreen.php";</script>';
}

$user = $_SESSION['name'];
?>
<head>
	<link rel="stylesheet" href="css/styles.css" type=text/css>
</head>
<img style="width: 20%;" src="img/cachecash.png" class="center">

<?php
if (isset($_SESSION['loggedin'])) {
	$sql = "SELECT balance FROM accounts WHERE username = '$user'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$curBalance = $stmt->fetch(PDO::FETCH_ASSOC)['balance'];
	?>
	<div class="container d-flex justify-content-center mt-5">
		<div class="card-profile">
			<h1>Purchase Cache Cash</h1>
			<div class="middle-container d-flex justify-content-between align-items-center mt-3 p-2">
				<div class="dollar-div px-3"></div>
				<div class="d-flex flex-column text-right mr-2">
					<span class="current-balance">Current Balance: </span>
					<span class="amount"><span class="dollar-sign">$</span><?php echo $curBalance; ?></span>
				</div>
			</div>
			<br>
			<form action="" method="GET">
				<div class="form-group d-flex-inline" style="display: flex">
					<label for="amount" style="flex: 3"><b>Amount to Purchase:</b></label>
					<input type="number" min="0.01" step="0.01" max="1000000" name="amount" style="flex: 6" required>

					<button type="submit" class="btn btn-primary ml-3" style="flex: 3">Purchase</button>
				</div>
			</form>
		</div>
	</div>
	<?php
		if(isset($_GET['amount'])) {
			$balance = $curBalance + $_GET['amount'];
			$sql2 = "UPDATE accounts SET balance ='$balance' WHERE username = '$user'";
			$stmt2 = $db->prepare($sql2);
			$stmt2->execute();
			unset($_GET['amount']);
			// header("Location: purchase.php");
			echo '<script>window.location.href = "/purchase.php";</script>';

		}
	?>
<?php
}
?>
