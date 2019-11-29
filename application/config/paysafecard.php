<?php

// PSC Config File

return [

    /*
     * Debug
     * Set Debug, will enable more details on errors
     * 0: No debug messages
     * 1: modal debug messages
     * 2: verbose output (requests, curl & responses)
     */

    'debug_level' => 1,

    /*
     * Key:
     * Set key, your psc key
     */

    'psc_key'     => '',

    /*
     * Logging:
     * enable logging of requests and responses to file, default: true
     * might be disbaled in production mode
     */

    'logging'     => false,

    /*
     * Environment
     * set the systems environment.
     * Possible Values are:
     * TEST = Test environment
     * PRODUCTION = Productive Environment
     *
     */

    'environment'   => 'PRODUCTION',
    'account_price' => '0.5',
    'ad_price'      => '0.02',
    'currency'      => 'EUR'

];
