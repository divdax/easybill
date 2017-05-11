<?php

return [

    /*
    |----------------------------------------------------------------------------
    | Easybill REST API Key
    |----------------------------------------------------------------------------
    |
    | This value is required to use the easybill.de REST API and perform actions
    | inside your easybill account to create customers, documents and many
    | other things over authenticated http requests to the easybill api.
    |
    */

    'api_key' => env('EASYBILL_API_KEY', null),

];
