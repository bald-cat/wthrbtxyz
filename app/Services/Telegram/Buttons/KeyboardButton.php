<?php

namespace App\Services\Telegram\Buttons;

class KeyboardButton
{

    protected string $text;
    protected bool $requestContact;
    protected bool $requestLocation;

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param bool $requestContact
     * @return KeyboardButton
     */
    public function setRequestContact(bool $requestContact): static
    {
        $this->requestContact = $requestContact;
        return $this;
    }

    /**
     * @param bool $requestLocation
     * @return KeyboardButton
     */
    public function setRequestLocation(bool $requestLocation): static
    {
        $this->requestLocation = $requestLocation;
        return $this;
    }

}
