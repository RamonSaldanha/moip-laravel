<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Defining application environment
    |--------------------------------------------------------------------------
    |
    | Define the key and the token has been approved by MoIP
    | If true, it will use the ambiende production
    | If false, it will use the development environment (sandbox)
    |
    */

    'homologated' => env('MOIP_HOMOLOGATED', false),

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | Any request to the API must be passed two keys 
    | key and token the environment configured in "homologated"
    |
    */
    'credentials' => [
        'key' => env('MOIP_KEY', '3UAWJSK9M66U5ZFD50JVBFILXBFVPEVI2BZ0OV1N'),
        'token' => env('MOIP_TOKEN', 'CZPFI3H3EMQEVDO6XEFQUDLSPMYW5OVZ'),
    ],
];
