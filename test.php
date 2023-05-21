<?php
declare(strict_types=1);

use MayMeow\FluentUiEmoji\Emojis;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

$text = 'Hello World! 💜😁🥚🥳🐹❓🛫⏲🤷‍♀️👷‍♀️👷‍♀️🔐🎮👾👨‍🦱👱‍♀️👩‍🦳🎅👮‍♀️🚞🚅🏚🏭🪑☮🕉💥💢';

$fluentEmojis = Emojis::init(SRC . '/Emojis.json');

file_put_contents('test.html', $fluentEmojis->replace($text));

