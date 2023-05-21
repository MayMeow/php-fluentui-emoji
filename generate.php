<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';

//traverse all subfolders and try to open metadata.json
function findEmojis()
{
    $emojis = [];
    $dir = new RecursiveDirectoryIterator(__DIR__ . '/lib/fluentui-emoji/assets');
    $iterator = new RecursiveIteratorIterator($dir);

    foreach ($iterator as $file) {
        if ($file->getFilename() === 'metadata.json') {
            $emoji = json_decode(file_get_contents($file->getPathname()), true);

            if ($emojiVariants = find3dVariants($file->getPath(), $emoji['cldr'])) {
                $emojis[$emoji['glyph']]['name'] = $emoji['cldr'];
                $emojis[$emoji['glyph']]['variants'] = $emojiVariants;
            }
        }
    }
    return $emojis;
}

// find 3d variants of emoji
function find3dVariants(string $path, string $emojiName): array
{
    $varians = [];

    $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($dir);

    foreach ($iterator as $file) {
        if ($file->getFilename() === sprintf('%s_3d.png', slug($emojiName)) || $file->getFilename() === sprintf('%s_3d_default.png', slug($emojiName))) {
            $varians['default'] = str_replace(EMOJI_DATA, '', $file->getPathname());
        }
    }

    return $varians;
}

//slugify emioji name
function slug(string $text, string $spaceReplace = '_'): string
{
    $text = preg_replace('~[^\pL\d]+~u', $spaceReplace, $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, $spaceReplace);
    $text = preg_replace('~-+~', $spaceReplace, $text);
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

$emojis = findEmojis();
var_dump($emojis);
var_dump(count($emojis));

file_put_contents(__DIR__ . '/src/Emojis.json', json_encode($emojis));

var_dump(dirname(__DIR__));