<?php

namespace App\Services\Telegram\Buttons;

class InlineKeyboardButton
{

    protected string $text;
    protected string $url;
    protected array $callback_data;

    /**
     * @param string $text
     * @return InlineKeyboardButton
     */
    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string $url
     * @return InlineKeyboardButton
     */
    public function setUrl(string $url): static
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param array $callback_data
     * @return InlineKeyboardButton
     */
    public function setCallbackData(array $callback_data): static
    {
        $this->callback_data = $callback_data;
        return $this;
    }

}
