<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<?php
require 'connect-db.php';
$user = $_SESSION['name'];

if($_GET['added']=="yes"){
    echo '<script>alert("Successfully added game!")</script>';
}

if($_GET['updated']=="yes"){
    echo '<script>alert("Successfully updated bet!")</script>';
}

function checkAdmin($db, $user){
        $sql = "SELECT admin FROM accounts WHERE username='$user'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $admin;
}

function getBets($db){
    $sql = "SELECT * FROM bets WHERE active=1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $admin;
}

$bets = getBets($db);

$admin = checkAdmin($db, $user);
if (intval($admin[0]['admin'] != 1)){
    echo '<script>alert("You do not have admin access"); window.location.href = "/";</script>';
    exit;
}

?>

<html>
<head>
	<title>Admin Page</title>
</head><body>
<div>&nbsp</div>
<style>
	.center {
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 50%;
  }
</style>
<img style="width: 20%;" src="img/cachecash.png" class="center">
<div class="container w-75 mt-5">
        <button id="show-form-btn" class="btn btn-success">Add Game</button>
		<form id="addGameForm" method="post" action="addGame.php" style="display: none;">

        <div class="form-group">
        <label for="league">League</label>
        <select class="form-control w-25" name="league" id="league" required>
            <option value="">Select a league</option>
            <option value="NBA">NBA</option>
            <option value="MLB">MLB</option>
            <option value="CBB">CBB</option>
            <option value="NHL">NHL</option>
        </select>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="homeTeam">Home Team Name</label>
            <input class="form-control w-75" name="homeTeam" id="homeTeam" required>
        </div>
        <div class="col">
            <label for="homeMoneyline">Home Moneyline:</label>
            <input type="number" class="form-control w-50" name="homeMoneyline" step="any" id="homeMoneyline" required>
        </div>
        <div class="col">
            <label for="homeSpread">Home Spread:</label>
            <input type="number" class="form-control w-50" name="homeSpread" step="any" id="homeSpread" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="awayTeam">Away Team Name</label>
            <input class="form-control w-75" name="awayTeam" id="awayTeam" required>
        </div>
        <div class="col">
            <label for="awayMoneyline">Away Moneyline:</label>
            <input type="number" class="form-control w-50" name="awayMoneyline" id="awayMoneyline" required>
        </div>
        <div class="col">
            <label for="awaySpread">Away Spread:</label>
            <input type="number" class="form-control w-50" name="awaySpread" step="any" id="awaySpread" required>
        </div>
    </div>

    <div class="form-group">
            <label for="overUnder">Over / Under:</label>
            <input type="number" class="form-control w-25" name="overUnder" step="any" id="overUnder" required>
        </div>

    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control w-25" name="date" id="date" required>
    </div>

    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


	</div>

    <div class="container w-75 mt-5">
    <button id="show-form-btn" onclick="toggleTableBets()" class="btn btn-success">Update Bet Result</button>
        <table id="betsTable" class="table table-bordered" style="display: none;">
        <thead>
            <th width=20%>Bet ID
            <th width="25%">Team
            <th width="25%">Wager
            <th width="25%">Amount
            <th width="25%">Active
            <th width="25%">Result
            <th width="25%">Update
        </tr>
        </thead>
        <?php
        foreach ($bets as $running_variable2):
        ?>
        <tr>
        <td><?php echo $running_variable2['bet_num']; ?></td> 
        <td><?php echo $running_variable2['team']; ?></td> 
        <td><?php echo $running_variable2['wager']; ?></td> 
        <td><?php echo $running_variable2['bet_type']; ?></td> 
        <td><?php echo $running_variable2['active']; ?></td> 
        <td>

            <form action="updateBetResult.php" method="POST">
                    <div class="form-group">
                        <select class="form-control" name="selectedOption" id="selectedOption" required style="width:200px;">
                            <option value="">Select an option</option>
                            <option value="Won">Won</option>
                            <option value="Lost">Lost</option>
                        </select>
                    </div>
        </td>
                <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                </td>
        </tr>
                <input type="hidden" name="bet_num" value="<?php echo $running_variable2['bet_num'] ?>" />
                <input type="hidden" name="game_id" value="<?php echo $running_variable2['game_id'] ?>" />
            </form>
<?php endforeach; ?>
	</div>
</div>
</body>
</html>
<style>
    .show-form {
  display: block !important;
}
</style>

<script>
const showFormButton = document.getElementById('show-form-btn');
const myForm = document.getElementById('addGameForm');

showFormButton.addEventListener('click', function() {
  myForm.classList.toggle('show-form');
});

function toggleTableBets() {
    var table = document.getElementById("betsTable");
    if (table.style.display === "none") {
      table.style.display = "table";
    } else {
      table.style.display = "none";
    }
  }
</script>