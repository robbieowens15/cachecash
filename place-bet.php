<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <body>
        <h2>Form Processing Debug Output:</h2>
            <?php
                require 'connect-db.php';
                include 'navbar.php';
                $prof = $_GET['prof'];
                $user = $_SESSION['name'];

                echo '<pre>';
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // process form data and generate output
                    echo "Post Request info\n";
                    var_dump($_POST);
                    place_bet();
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
                    echo "User Attributes: ";
                    echo var_dump($user_tuple);
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
                    echo "User has bet?";
                    echo var_dump($has_bet);
                    if ($has_bet[0]["result"] == 1) {
                        echo "<h1>Already bet on this game</h1>";
                    }

                    // Check if user has enough money
                    if ($user_tuple[0]['balance'] < floatval($_POST['wager_amount'])) {
                        echo "<h1>Error Balance is too low</h1>";
                    }

                    //Get the game the user want to bet on
                    $query_game = "SELECT home_team, away_team FROM games WHERE game_id = :game_id";
                    $statement = $db->prepare($query_game);
                    $statement->bindValue(':game_id', $_POST['game_id']);
                    $statement->execute();
                    $teams = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $statement->closeCursor();
                    echo "Teams: ";
                    echo var_dump($teams);

                    $team = NULL; //default for OVER UNDER
                    $type = NULL;
                    if ($_POST['selectedOption'] == "Away Moneyline" OR $_POST['selectedOption'] == "Away Spread"){
                        $team = $teams[0]['away_team'];
                        if ($_POST['selectedOption'] == "Away Moneyline") {
                            $type = "Moneyline";
                        } else {
                            $type = "Spread";
                        }
                    } else if ($_POST['selectedOption'] == "Home Moneyline" OR $_POST['selectedOption'] == "Home Spread") {
                        $team = $teams[0]['home_team'];
                        if ($_POST['selectedOption'] == "Home Moneyline") {
                            $type = "Moneyline";
                        } else {
                            $type = "Spread";
                        }
                    }
                    if ($type == NULL) {
                        $type = "OverUnder";
                    }
                    echo "Selected the team: " . $team . "\n";
                    echo "Enum Bet Type: " . $type . "\n";

                    //Add new bet
                    $user_id = intval($user_tuple[0]['id']);
                    $game_id = intval($_POST['game_id']);
                    $wager = floatval($_POST['wager_amount']);

                    $sql = "INSERT INTO 
                        bets(account_id, game_id, team, wager, bet_type, active) 
                        VALUES ($user_id, $game_id, '$team', $wager, '$type', True)";
                    $db->exec($sql);
                    echo "Successful Bet placed!";
                }
                echo '</pre>';
            ?>
    </body>
</html>