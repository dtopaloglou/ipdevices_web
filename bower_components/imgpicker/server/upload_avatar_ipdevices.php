<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');


// Include Database classs
require  __DIR__.'/DB/Database.php';

Database::connect(require __DIR__.'/DB/config.php');

// Include ImgPicker class
require __DIR__ . '/ImgPicker.php';

// Let's say that you grab the user id from the session
$userId = $_SESSION['uid'];

// ImgPicker options
$options = array(
    // Upload directory path
    'upload_dir' => __DIR__ . '/../files/',
    // Upload directory url
    'upload_url' => 'bower_components/imgpicker/files/',

    'max_file_size' => CoreConfig::settings()['avatars']['max_upload'],

    // Image versions
    'versions' => CoreConfig::settings()['avatars']['versions'],

    'load' => function () use ($userId) {
        // Select the image for the current user
        $db = new Database;
        $results = $db->table('client')
            ->where('uid', $userId)
            ->limit(1)
            ->get();


        if ($results) {
            return $results[0]->avatar;   // column name is avatar
        } else {
            return false;
        }
    },
    // Upload start callback
    'upload_start' => function ($image) use ($userId) {
        // Name the temp image as $userId
        $image->name = '~'.$userId.'.'.$image->type;
    },
    // Crop start callback
    'crop_start' => function ($image) use ($userId) {
        // Change the name of the image
        $image->name = $userId.'.'.$image->type;
    },
    // Crop complete callback
    'crop_complete' => function ($image) use ($userId) {
        // Save the image to database
        $data = array(
            'uid' => $userId,
            'avatar' => $image->name
        );

        $db = new Database;
        // First check if the image exists
        $results = $db->table('client')
            ->where('uid', $userId)
            ->limit(1)
            ->get();

        // If exists update, otherwise insert
        if ($results) {
            $db->table('client')
                ->where('uid', $userId)
                ->limit(1)
                ->update($data);
        } else {
            $db->table('client')->insert($data);
        }
    }
);

// Create ImgPicker instance
new ImgPicker($options);