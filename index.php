<?php
define('APP_DEBUG', true);
require './fillwork/Fillphp.php';
require './vendor/autoload.php';
(new fillwork\Fillphp())->run();