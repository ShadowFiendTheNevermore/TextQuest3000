<?php 

require __DIR__ . '/../vendor/autoload.php';

use TextQuest\HtmlOuter\HtmlOuter;

$app = HtmlOuter::getInstance();

$app->setPathToPages(realpath(__DIR__ . '/../pages/'));

$app->route('/', 'indexpage.html');

$app->route('phpinfo', 'phpinfo.php');

$app->route('auth', 'authpage.html');

$app->route('auth/register', 'auth_login.php');

$app->run();

