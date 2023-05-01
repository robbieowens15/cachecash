<?php
require 'connect-db.php';

    function getGameId($db){
        $sql = "SELECT MAX(game_id) AS game_id FROM games";
        $stmt = $db->prepare($sql);
		$stmt->execute();
		$game_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $game_id;

    }

    function addGame($db, $game_id, $league, $homeTeam, $awayTeam, $homeSpread, $awaySpread, $overUnder, $homeMoneyline, $awayMoneyline, $date) {
		$sql = "INSERT INTO games (game_id, league, home_team, away_team, homeSpread, awaySpread, over_under, homeMoneyline, awayMoneyline, game_date) VALUES ($game_id, '$league', '$homeTeam', '$awayTeam', $homeSpread, $awaySpread, $overUnder, $homeMoneyline, $awayMoneyline, '$date')";
        echo $sql;
        $db->exec($sql);
	}

    $league = $_POST['league'];
    $homeTeam = $_POST['homeTeam'];
    $homeMoneyline = $_POST['homeMoneyline'];
    $homeSpread = $_POST['homeSpread'];
    $awayTeam = $_POST['awayTeam'];
    $awayMoneyline = $_POST['awayMoneyline'];
    $awaySpread = $_POST['awaySpread'];
    $overUnder = $_POST['overUnder'];
    $date = $_POST['date'];


    $game_id = intval(getGameId($db)[0]["game_id"]) + 1;
    addGame($db, $game_id, $league, $homeTeam, $awayTeam, $homeSpread, $awaySpread, $overUnder, $homeMoneyline, $awayMoneyline, $date);
    // header('Location: /admin.php?added=yes');
    echo '<script>window.location.href = "/admin.php?added=yes";</script>';
?>