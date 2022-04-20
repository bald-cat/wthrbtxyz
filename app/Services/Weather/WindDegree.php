<?php

namespace App\Services\Weather;

class WindDegree
{

    private $windDeg;

    public function setDeg($spend)
    {
        $this->windDeg = $spend;
        return $this;
    }

    public function getDeg()
    {

        $windEmojis = config('emojis.winter-deg');

        $windDeg = '';
        if ($this->windDeg == 360) {
            $windDeg = "{$windEmojis['N']} <i>Направление ветра:</i> Северный ($this->windDeg &#176;)";
        } elseif ($this->windDeg == 180) {
            $windDeg = "{$windEmojis['S']} <i>Направление ветра:</i> Южный ($this->windDeg &#176;)";
        } elseif ($this->windDeg == 90) {
            $windDeg = "{$windEmojis['E']} <i>Направление ветра:</i> Восточный ($this->windDeg &#176;)";
        } elseif ($this->windDeg == 270) {
            $windDeg = "{$windEmojis['W']} <i>Направление ветра:</i> Западный ($this->windDeg &#176;)";
        } elseif ($this->windDeg > 270 && $this->windDeg < 360) {
            $windDeg = "{$windEmojis['S-E']} <i>Направление ветра:</i> Северо-Западный ($this->windDeg &#176;)";
        } elseif ($this->windDeg > 180 && $this->windDeg < 270) {
            $windDeg = "{$windEmojis['N-E']} <i>Направление ветра:</i> Юго-Западный ($this->windDeg &#176;)";
        } elseif ($this->windDeg > 90 && $this->windDeg < 180) {
            $windDeg = "{$windEmojis['N-W']} <i>Направление ветра:</i> Юго-Восточный ($this->windDeg &#176;)";
        } elseif ($this->windDeg < 90) {
            $windDeg = "{$windEmojis['S-W']} <i>Направление ветра:</i> Северо-Восточный ($this->windDeg &#176;)";
        }
        return $windDeg;
    }

}
