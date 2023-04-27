<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                   // URL (without file name) to a default screen
      require 'navbar.php';
      require 'homescreen.php';
      break;
    case '/league.php':     // if you plan to also allow a URL with the file name
      require 'navbar.php';
      require 'league.php';
      break;
   case '/games.php':
      require 'navbar.php';
      require 'league.php';
      break;
   case '/login.php':
      require 'navbar.php';
      require 'login.php';
      break;
   case '/test.php':
      require 'test.php';
      break;
   default:
      http_response_code(404);
      exit('Not Found');
}
?>