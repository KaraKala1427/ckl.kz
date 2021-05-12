<?php
return [
    'base_route'      => 'admin/filemanager',
    'middleware'      => ['web', 'auth'],
    'allow_format'    => 'jpeg,jpg,png,gif,webp,pdf',
    'max_size'        => 5000,
    'max_image_width' => 1024,
    'image_quality'   => 80,
];
