<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'cachecash-381521:us-east4:cache-instance');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Wahoos4750');
define('DB_NAME', 'CacheCash');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '862413716823-2o2rpn02a7lkb64vua6ctr94p7d6ohnu.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'https://cachecash-381521.uk.r.appspot.com');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);