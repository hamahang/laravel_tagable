<?php

return [

    /* Important Settings */
    'backend_lts_middlewares'   => explode(',', env('BACKEND_lTS_MIDDLEWARES', 'web')),
    'frontend_lts_middlewares'  => explode(',', env('FRONTEND_lTS_MIDDLEWARES', 'web')),
    // you can change default route from sms-admin to anything you want
    'backend_lts_route_prefix'  => env('BACKEND_lTS_ROUTE_PERFIX', 'lTS'),
    'frontend_lts_route_prefix' => env('FRONTEND_lTS_ROUTE_PERFIX', 'lTS'),
    // ======================================================================
    //allow user to upload private file in filemanager
    'user_model'                => env('lTS_USER_MODEL', 'App\User'),
    'multi_lang'                => env('lTS_MULTI_LANG', 'LTS_SampleLang'),
];