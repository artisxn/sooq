<?php

return [
    /*
    * The POS key to be sent with all API requests. You can acquire one
    * by creating a shop after logging in to your Barion account.
    */
    'pos_key'          => '',
     
    /*
    * Value indicating whether to use the live Barion environment instead
    * of the test one. Defaults to false just to be sure.
    */
    'live_environment' => true,
     
    /*
    * Value indicating whether to decode the JSON response returned by the
    * Barion API to associative arrays instead of standard PHP objects.
    */
    'associative'      => false,
];