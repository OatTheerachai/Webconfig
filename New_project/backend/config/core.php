<?php
    // show error reporting
    error_reporting(E_ALL);
    
    // set your default time-zone
    date_default_timezone_set('Asia/Bangkok');
    
    // variables used for jwt
    $key = "tabsoft";
    $issued_at = time();
    $expiration_time = $issued_at + (60 * 60); // valid for 1 hour
    $issuer = "http://localhost/RestApi/";
?>