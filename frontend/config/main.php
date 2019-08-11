<?php

return [
    'name' => 'Frontend',
    'siteName' => 'YAPF',
    'version' => '1.0.0',
    'basePath' => dirname(__DIR__),
    'backendUrl' => 'http://backend.framework.local',
    'routes' => [
        '/robots.txt' => 'site/robots',
        '/sitemap.xml' => 'site/sitemap',
        '/blog' => 'blog/index',
        '/blog/:num.html' => 'blog/viewBlog/$1',
        '/blog/:any/:num.html' => 'blog/viewPost/$1/$2',
    ],
];