# FluentUI Emoji for PHP

Library to use FluentUI Emojis with PHP application

```bash
composer require maymeow/php-fluentui-emoji
```
Copy `src/Emojis.json` somewhere to your application. You will also need to put soewhere `assets` folder from https://github.com/microsoft/fluentui-emoji

## How to use

```php
$text = 'Hello World! 💜😁🥚🥳🐹❓🛫⏲🤷‍♀️👷‍♀️👷‍♀️🔐🎮👾👨‍🦱👱‍♀️👩‍🦳🎅👮‍♀️🚞🚅🏚🏭🪑☮🕉💥💢';

$fluentEmojis = Emojis::init(SRC . '/Emojis.json');

file_put_contents('test.html', $fluentEmojis->replace($text));
```