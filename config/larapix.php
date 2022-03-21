<?php

return [
    /*
   |--------------------------------------------------------------------------
   | Larapix Config
   |--------------------------------------------------------------------------
   |
   | This option controls the base data about Larapix OpenPix integration
   | based on URI's and keys that you might need to make transactions.
   |
   | Params:
   | 'base_url' -> API base URL that might change with a new API release
   | 'app_id' -> App Key/Secret that you will generate on OpenPix API
   */

    'base_url' => env('LARAPIX_BASE_URL', 'https://api.openpix.com.br/api/openpix/v1'),

    'app_id' => env('LARAPIX_APP_ID', 'appId')
];
