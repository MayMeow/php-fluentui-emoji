<?php
declare(strict_types=1);

namespace MayMeow\FluentUiEmoji;

enum EmojiVariant: string
{
    case DEFAULT = 'default';
    case LIGHT = 'light';
    case DARK = 'dark';
}