<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<?php
include 'navbar.php';
include 'connect-db';

if($_GET['created']=="yes"){
    echo '<script>alert("Successfully registered! Please sign in")</script>';
}
?>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/cachecash.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 login">
	  <h2 class="center">Login</h2>
	  <form action="auth.php" method="post">
	  <div class="form-outline mb-4">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<div class="form-outline mb-4">
				<input type="text" name="username" placeholder="Username" id="username"  class="form-control form-control-lg" required>
				</div>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<div class="form-outline mb-4">
				<input type="password" name="password" placeholder="Password" id="password" class="form-control form-control-lg" required>
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
		</form>
				<h2 class="center">Register</h2>
				<form action="register.php" method="post" autocomplete="off">

				<input type="text" name="username" placeholder="Username" id="username" class="form-control form-control-lg" required>
			&nbsp;
				<input type="password" name="password" placeholder="Password" id="password" class="form-control form-control-lg" required>
				&nbsp;
				<input type="email" name="email" placeholder="Email" id="email" class="form-control form-control-lg" required>
                &nbsp;
				<div class="form-outline mb-4">
				<input type="number" name="age" placeholder="Age" id="age" class="form-control form-control-lg" required>
				</div>
				<button type="submit" class="btn btn-primary">Register</button>
				
			</form>



		
    

      </div>
    </div>
  </div>
</section>