<?php
declare(strict_types=1);

namespace MayMeow\FluentUiEmoji;

class FluentEmoji
{
    protected ?string $cldr;
    protected string $imgPath;
    protected EmojiVariant $emojiVariant;

    public function __construct(string $imgPath, EmojiVariant $emojiVariant = EmojiVariant::DEFAULT, ?string $cldr = null)
    {
        $this->cldr = $cldr;
        $this->imgPath = $imgPath;
        $this->emojiVariant = $emojiVariant;
    }

    public function getCldr(): ?string
    {
        return $this->cldr;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    public function getEmojiVariant(): EmojiVariant
    {
        return $this->emojiVariant;
    }
}