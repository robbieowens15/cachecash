<?php
// Include configuration file
require_once 'config.php';

// Include User library file
require_once 'User.class.php';

switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                   // URL (without file name) to a default screen
      require 'homescreen.php';
      break;
    case '/league.php':     // if you plan to also allow a URL with the file name 
        require 'league.php';
        break;
   default:
      http_response_code(404);
      exit('Not Found');
}