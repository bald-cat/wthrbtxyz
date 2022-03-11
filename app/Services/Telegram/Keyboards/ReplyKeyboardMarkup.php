<?php

namespace App\Services\Telegram\Keyboards;

class ReplyKeyboardMarkup
{

    protected $keyboard;

    /**
     * @param mixed $keyboard
     * @return ReplyKeyboardMarkup
     */
    public function setKeyboard(mixed $keyboard): static
    {
        $this->keyboard = $keyboard;
        return $this;
    }

}
