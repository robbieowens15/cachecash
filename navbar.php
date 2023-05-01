<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/styles.css" type=text/css>
</head>
<body>

<header>
	<nav>
		<ul>
			<li class="active"><a href="/">Home</a></li>
			<li><a href="/profile.php">Profile</a></li>
			<li><a href="/games.php">Games</a></li>
			<li><a href="/leaderboard.php">Leaderboard</a></li>
			<li><a href="/smacktalk.php">Smack Talk Arena</a></li>
			<li><a href="/purchase.php">Purchase Cache Cash</a></li>
			<?php
			date_default_timezone_set("America/New_York");
			// Check if the user is logged in
			if (!isset($_SESSION['loggedin'])) {
				?>
				<li style="float:right"><a href="/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<?php
			}
			else{
				?>
				<li style="float:right"><a href="/logout.php"><span class="glyphicon glyphicon-log-in"></span> 
				<?php
				echo 'Welcome ' . $_SESSION['name'] . '!'; ?>
				Logout</a>
			</li>
				<?php
			}
			?>
		</ul>
	</nav>
</header>

<!-- <header>
	<nav>
		<ul>
			<li class="active"><a href="/cachecash/homescreen.php">Home</a></li>
			<li><a href="/cachecash/profile.php">Profile</a></li>
			<li><a href="/cachecash/games.php">Games</a></li>
			<li><a href="/cachecash/leaderboard.php">Leaderboard</a></li>
			<li><a href="/cachecash/smacktalk.php">Smack Talk Arena</a></li>
			<li><a href="/cachecash/purchase.php">Purchase Cache Cash</a></li>

			 /*
			session_start();
			date_default_timezone_set("America/New_York");
			// Check if the user is logged in
			if (!isset($_SESSION['loggedin'])) {
				*/ ?>
				<li style="float:right"><a href="/cachecash/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				
			}
			else{
				?>
				<li style="float:right"><a href="/cachecash/logout.php"><span class="glyphicon glyphicon-log-in"></span> 
				
				echo 'Welcome ' . $_SESSION['name'] . '!'; ?>
				Logout</a>
			</li>
			}
			?>
		</ul>
	</nav>
</header> -->
		</body>
</html>