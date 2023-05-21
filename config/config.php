<?php
declare(strict_types=1);

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('ROOT', dirname(__DIR__));
define('EMOJI_DATA', ROOT. DS . 'lib' . DS . 'fluentui-emoji');
define('SRC', ROOT . DS . 'src');