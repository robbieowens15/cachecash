<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                   // URL (without file name) to a default screen
      require 'navbar.php';
      require 'homescreen.php';
      break;
   case '/addComment.php':
      require 'navbar.php';
      require 'addComment.php';
      break;
   case '/addFriend.php':
      require 'navbar.php';
      require 'addFriend.php';
      break;
   case '/addGame.php':
      require 'navbar.php';
      require 'addGame.php';
      break;
   case '/admin.php':
      require 'navbar.php';
      require 'admin.php';
      break;
   case '/auth.php':
      // require 'navbar.php';
      require 'auth.php';
      break;
   case '/games.php':
      require 'navbar.php';
      require 'games.php';
      break;
   case '/leaderboard.php':
      require 'navbar.php';
      require 'leaderboard.php';
      break;
   case '/league.php':     // if you plan to also allow a URL with the file name
      require 'navbar.php';
      require 'league.php';
      break;
   case '/login.php':
      require 'navbar.php';
      require 'login.php';
      break;
   case '/logout.php':
      require 'navbar.php';
      require 'logout.php';
      break;
   case '/place-bet.php':
      require 'navbar.php';
      require 'place-bet.php';
      break;
   case '/profile.php':
      require 'navbar.php';
      require 'profile.php';
      break;
   case '/purchase.php':
      require 'navbar.php';
      require 'purchase.php';
      break;
   case '/register.php':
      include 'navbar.php';
      require 'register.php';
      break;
   case '/smacktalk.php':
      require 'navbar.php';
      require 'smacktalk.php';
      break;
   case '/updateBetResult.php':
      require 'navbar.php';
      require 'updateBetResult.php';
      break;
   default:
      http_response_code(404);
      exit('Not Found');
}
?>