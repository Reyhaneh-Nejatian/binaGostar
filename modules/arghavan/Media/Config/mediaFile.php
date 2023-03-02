<?php
return [
    "MediaTypeServices" => [
        "image" => [
            "extensions" => [
                'png','jpg','jpeg'
            ],
            "handler" => \arghavan\Media\Services\ImageFileService::class
        ],
    ]
];
