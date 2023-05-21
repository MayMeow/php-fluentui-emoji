<?php
declare(strict_types=1);

namespace MayMeow\FluentUiEmoji;

class Emojis
{
    protected array $fluentUiEmojis = [];

    private function __construct(string $emojiData)
    {
        $emojis = json_decode(file_get_contents($emojiData), true);
        $this->fluentUiEmojis = $emojis;
    }

    public static function init(string $emojiData): self
    {
        return new self($emojiData);
    }

    //extract emojis from text
    public function extract(string $text): array
    {
        $emojis = [];
        $pattern = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1F1E0}-\x{1F1FF}]/u';
        preg_match_all($pattern, $text, $emojis);
        return $emojis[0];
    }

    // get emoji
    public function get(string $glyph, EmojiVariant $preferedVariant = EmojiVariant::DEFAULT): ?FluentEmoji
    {
        if (array_key_exists($glyph, $this->fluentUiEmojis)) {
            $path = $this->fluentUiEmojis[$glyph]['variants'][$preferedVariant->value];
            $name = array_key_exists('name', $this->fluentUiEmojis[$glyph]) ? $this->fluentUiEmojis[$glyph]['name'] : null;

            return new FluentEmoji($path, $preferedVariant, $name);
        }

        return null;
    }

    //replace all emojis in text with images
    public function replace(string $text, EmojiVariant $preferedVariant = EmojiVariant::DEFAULT): string
    {
        $emojis = $this->extract($text);
        foreach ($emojis as $emoji) {
            $fluentEmoji = $this->get($emoji, $preferedVariant);
            if ($fluentEmoji != null)
            {
                $text = str_replace($emoji, sprintf('<img src="%s" alt="%s" />', $fluentEmoji->getImgPath(), $fluentEmoji->getCldr()), $text);
            }
        }
        return $text;
    }
}