<?php

return [

    /* Important Settings */
    'backend_lts_middlewares' => ['web'],
    'frontend_lts_middlewares' => ['web'],
    // you can change default route from sms-admin to anything you want
    'backend_lts_route_prefix' => 'LTS',
    'frontend_lts_route_prefix' => 'LTS',
    // ======================================================================
    //allow user to upload private file in filemanager
    'userModel'=>'App\User',
    'multiLang'=> env('LPM_MULTILANG', 'faq_sampleLang'),
];