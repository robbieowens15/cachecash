<?php
    require 'connect-db.php';
    $prof = $_GET['prof'];
    $user = $_SESSION['name'];

    // echo '<pre>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // process form data and generate output
        // echo "Post Request info\n";
        // var_dump($_POST);
        place_bet();
    }


    function updateBalance($db, $user, $val){
        $val = floatval($val);
        $sql = "UPDATE accounts SET balance = balance - $val WHERE username = '$user'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    // function place_bet($db, $game_id, $bet_type, $wager){
    function place_bet() {
        global $db;

        // Find user
        $query_get_user = "SELECT id, balance FROM accounts WHERE username = :username";
        $statement = $db->prepare($query_get_user);
        $statement->bindValue(':username', $_SESSION['name']);
        $statement->execute();
        $user_tuple = $statement->fetchAll(PDO::FETCH_ASSOC);
        // echo "User Attributes: ";
        // echo var_dump($user_tuple);
        $statement->closeCursor();

        //Check if user already bet on this game
        $query_check_already_bet = "SELECT IF(EXISTS (
            SELECT * FROM bets 
            WHERE game_id = :game_id AND account_id = :account_id
            ),
            1,
            0
        ) AS result";
        $statement = $db->prepare($query_check_already_bet);
        $statement->bindValue(':account_id', $user_tuple['id']);
        $statement->bindValue(':game_id', $_POST['game_id']);
        $statement->execute();
        $has_bet = $statement->fetchAll(PDO::FETCH_ASSOC);
        // echo "User has bet?";
        // echo var_dump($has_bet);
        if ($has_bet[0]["result"] == 1) {
            echo '<script>alert("Already bet on this game"); window.location.href = "/games.php";</script>';
        }

        // Check if user has enough money
        if ($user_tuple[0]['balance'] < floatval($_POST['wager_amount'])) {
            echo '<script>alert("Insufficient CacheCash"); window.location.href = "/games.php";</script>';
        }

        //Get the game the user want to bet on
        $query_game = "SELECT home_team, away_team FROM games WHERE game_id = :game_id";
        $statement = $db->prepare($query_game);
        $statement->bindValue(':game_id', $_POST['game_id']);
        $statement->execute();
        $teams = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        // echo "Teams: ";
        // echo var_dump($teams);

        $team = NULL; //default for OVER UNDER
        $type = NULL;
        if ($_POST['selectedOption'] == "Away Moneyline" OR $_POST['selectedOption'] == "Away Spread"){
            $team = $teams[0]['away_team'];
            if ($_POST['selectedOption'] == "Away Moneyline") {
                $type = "Away_Moneyline";
            } else {
                $type = "Spread";
            }
        } else if ($_POST['selectedOption'] == "Home Moneyline" OR $_POST['selectedOption'] == "Home Spread") {
            $team = $teams[0]['home_team'];
            if ($_POST['selectedOption'] == "Home Moneyline") {
                $type = "Home_Moneyline";
            } else {
                $type = "Spread";
            }
        }
        if ($type == NULL) {
            $type = "OverUnder";
        }
        //echo "Selected the team: " . $team . "\n";
        //echo "Enum Bet Type: " . $type . "\n";

        //Add new bet
        $user_id = intval($user_tuple[0]['id']);
        $game_id = intval($_POST['game_id']);
        $wager = floatval($_POST['wager_amount']);

        $sql = "INSERT INTO 
            bets(account_id, game_id, team, wager, bet_type, active) 
            VALUES ($user_id, $game_id, '$team', $wager, '$type', True)";
        $db->exec($sql);

        updateBalance($db, $_SESSION['name'], $wager);
        // header('Location: /games.php?bet=yes');
        echo '<script>window.location.href = "/games.php?bet=yes";</script>';
        //echo "Successful Bet placed!";
    }
    // echo '</pre>';
?>