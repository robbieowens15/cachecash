<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/styles.css" type=text/css>
</head>
<body>
<!--
<header>
	<nav>
		<ul>
			<li class="active"><a href="https://cachecash-381521.uk.r.appspot.com/">Home</a></li>
			<li><a href="https://cachecash-381521.uk.r.appspot.com/profile.php">Profile</a></li>
			<li><a href="https://cachecash-381521.uk.r.appspot.com/games.php">Games</a></li>
			<li><a href="https://cachecash-381521.uk.r.appspot.com/purchase.php">Purchase Cache Cash</a></li>
			<?php /*
			session_start();
			// Check if the user is logged in
			if (!isset($_SESSION['loggedin'])) {
				?>
				<li style="float:right"><a href="/cachecash/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<?php
			}
			else{
				?>
				<li style="float:right"><a href="/cachecash/logout.php"><span class="glyphicon glyphicon-log-in"></span> 
				<?php
				echo 'Welcome ' . $_SESSION['name'] . '!'; ?>
				Logout</a>
			</li>
				<?php
			}
			*/ ?>
		</ul>
	</nav>
</header>
-->
<header>
	<nav>
		<ul>
			<li class="active"><a href="/cachecash/homescreen.php">Home</a></li>
			<li><a href="/cachecash/profile.php">Profile</a></li>
			<li><a href="/cachecash/games.php">Games</a></li>
			<li><a href="/cachecash/leaderboard.php">Leaderboard</a></li>
			<li><a href="/cachecash/purchase.php">Purchase Cache Cash</a></li>

			<?php
			session_start();
			// Check if the user is logged in
			if (!isset($_SESSION['loggedin'])) {
				?>
				<li style="float:right"><a href="/cachecash/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<?php
			}
			else{
				?>
				<li style="float:right"><a href="/cachecash/logout.php"><span class="glyphicon glyphicon-log-in"></span> 
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
		</body>
</html>