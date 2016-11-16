<?php
//charge tous les package composer
require 'vendor/autoload.php';

use SocialLinks\Page;


//Create a Page instance with the url information
$page = new Page([
    'url' => 'http://mypage.com',
    'title' => 'Home project toto',
    'text' => 'Extended page description',
    'image' => 'http://mypage.com/image.png',
    'twitterUser' => '@twitterUser'
]);

//Debug
//echo $page->facebook->shareUrl;
//exit();

// VIEW
require 'views/header.php';
require 'views/home.php';
require 'views/footer.php';