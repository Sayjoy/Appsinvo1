<?php
//Replace in /vendor/barryvdh/laravel-snappy/config/
//Edit permissions for vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64, make executable 555 or 777
return array(


    'pdf' => array(
        'enabled' => true,
        //'binary'  => '/usr/local/bin/wkhtmltopdf',
        'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        //'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\wkhtmltopdf.exe'),
        //'binary' =>'"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        //'binary'  => '/usr/local/bin/wkhtmltoimage',
        'binary' => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
        //'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\wkhtmltoimage'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
