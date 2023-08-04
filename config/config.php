<?php

return [
    'storage_path'  =>   '/storage/themes/company/',
    'throttle' => [
        'request-verification' => [
            'time' => 2,
            'visits'    =>  1
        ],
        'submit-verification'   =>  [
            'time'  =>  1,
            'visits'    =>  4
        ],
        'submit-phonenumber' => [
            'time'  =>  1,
            'visits'    =>  5
        ],
    ],
    'logo' => ['small' => 'logo-small.png'],
    'favicon' => ['width' => '50'],
    'og'    => ['width' => '300'],

    'empty' =>  'empty.png',
    'models'  =>  [
        'product' => 'App\Models\Product'
    ],
    'slider'    =>  ['width' => '1024'],
    'resume'    =>  ['width' => '400'],
    'logo'      =>  ['width' => '300'],
    'user'      =>  ['width' => '200'],

    'disk-name' => 'company',
];
?>
