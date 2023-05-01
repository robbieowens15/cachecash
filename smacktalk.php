<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
require 'connect-db.php';
if(!isset($_SESSION['name'])){
    echo '<script>alert("Please log in to access"); window.location.href = "/";</script>';
}

if($_GET['added']=="yes"){
    echo '<script>alert("Successfully added comment!")</script>';
}

function getMessages($db) {
    $sql = "SELECT username, comment_value, date_posted FROM comments NATURAL JOIN accounts ORDER BY date_posted DESC LIMIT 30";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

function getCommentCount($db, $user){
    $sql = "SELECT comment_number FROM post NATURAL JOIN accounts WHERE username='$user'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

$comments = getMessages($db);

?>

<img style="width: 20%;" src="img/cachecash.png" class="center">
<div class="form-outline mb-4 w-50 center">
    <form method="post" action="addComment.php" >
          <input type="text" name="commentVal" id="commentVal" class="form-control" placeholder="Talk smack!" required/>
          <button type="submit" class="btn btn-primary center w-25">Submit</button>
    </form>
 </div>

  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="card text-dark">
          <div class="card-body p-4">
            <h4 class="mb-0">Recent comments</h4>
            <div>&nbsp</div>
            
        <?php foreach ($comments as $comment) : ?>

          <div class="card-body p-4">
            <div class="d-flex flex-start">
              <div>
                <h5 class="fw-bold mb-1"><?php echo $comment['username']; ?></h5>
                <div class="d-flex align-items-center mb-3">
                <p class="mb-0">
                  <?php echo getCommentCount($db, $comment['username'])[0]['comment_number'] . " comments" ?>
                  
                <br>
                  <?php echo $comment['date_posted'];?>
                </p>
                  <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                  <a href="#!" class="text-success"><i class="fas fa-redo-alt ms-2"></i></a>
                  <a href="#!" class="link-danger"><i class="fas fa-heart ms-2"></i></a>
                </div>
                <p class="mb-0">
                    <?php echo $comment['comment_value']; ?>
                </p>
              </div>
            </div>
          </div>

          <div>&nbsp</div>

          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
