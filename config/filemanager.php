<?php
return [
    'base_route'      => 'admin/filemanager',
    'middleware'      => ['web', 'auth'],
    'allow_format'    => 'jpeg,jpg,png,gif,webp,pdf,zip,rar',
    'max_size'        => 11000,
    'max_image_width' => 4048,
    'image_quality'   => 100,
];
