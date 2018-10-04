<?php

return [

    /* Important Settings */
    'backend_lts_middlewares'   => explode(',', env('LTS_BACKEND_MIDDLEWARES', 'web')),
    'frontend_lts_middlewares'  => explode(',', env('LTS_FRONTEND_MIDDLEWARES', 'web')),
    // you can change default route from sms-admin to anything you want
    'backend_lts_route_prefix'  => env('LTS_BACKEND_ROUTE_PERFIX', 'lTS'),
    'frontend_lts_route_prefix' => env('LTS_FRONTEND_ROUTE_PERFIX', 'lTS'),
    // ======================================================================
    //allow user to upload private file in filemanager
    'user_model'                => env('LTS_USER_MODEL', 'App\User'),
    'multi_lang'                => env('LTS_MULTI_LANG', 'LTS_SampleLang'),
];