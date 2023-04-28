<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <body>
        <h2>Form Processing Debug Output:</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // process form data and generate output
                    $output = var_dump($_POST);
                
                    // display output in a preformatted way
                    echo '<pre>';
                    echo $output;
                    echo '</pre>';
                }
                

                require 'connect-db.php';
                include 'navbar.php';
                $prof = $_GET['prof'];
                $user = $_SESSION['name'];

                if (isset($_POST['submit'])) {
                    // place_bet($db, $game_id, $bet_type, $wager);
                    place_bet();
                }

                // function place_bet($db, $game_id, $bet_type, $wager){
                function place_bet() {
                    $wager_amount = $_POST['bet_amount'];
                    $selectedOption = $_POST["selectedOption"];
                    var_dump($selectedOption);
                    var_dump($wager_amount);
                    echo "<p>";
                        echo "The user entered a bet amount of: " . $wager_amount;
                        echo "The user entered a bet type of: " . $selectedOption;
                        echo var_dump($wager_amount);
                        echo var_dump($selectedOption);
                    echo "</p>";

                    // $sql = "INSERT INTO bets(bet_num, email, game_id, team, wager, bet_type, active) 
                    // VALUES(...);";
                    // $stmt = $db->prepare($sql);
                    // $stmt->execute();
                }
            ?>
    </body>
</html>