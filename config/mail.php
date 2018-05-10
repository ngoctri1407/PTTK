<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'), 
    'host' => env('MAIL_HOST', 'smtp.gmail.com'), 
    'port' => env('MAIL_PORT', 587), 
    'from' => ['address' => 'youremail@mail.com', 'name' => 'Contact_SGHome'], 

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME','yourusername@mail.com'),
    'password' => env('MAIL_PASSWORD','youremailpassword'),
    'sendmail' => '/usr/sbin/sendmail -bs',

];
