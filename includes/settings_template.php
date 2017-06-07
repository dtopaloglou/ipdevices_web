<?php
return array(

    'appname'       => 'IPDevices',
    'protocol'      => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://",
    'timezone'      => 'America/Montreal',
    'avatars' => array(
        'max_upload' => min((int)ini_get('post_max_size'), (int)(ini_get('upload_max_filesize'))) * 1024 * 1024,
        'versions' => array(
            'avatar' =>
                array(
                    'crop' => true,
                    'max_width' => 200,
                    'max_height' => 200
                ),
            'small' =>
                array(
                    'crop' => true,
                    'max_width' => 30,
                    'max_height' => 30
                ),
        ),
    ),
    'email' => array(
        'username' => 'admin@mydomain.com',
        'password' => 'mypassword',
        'incoming_server' => 'pop.mydomain.com',
        'outgoing_server' => 'smtp.mydomain.com',
        'smtp_port' => '465',
        'smtp_auth' => true
    )

);

?>