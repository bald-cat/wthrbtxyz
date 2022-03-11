<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\CityTable;
use Illuminate\Support\Arr;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class City extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $citiesCount = \App\Models\City::query()->select(['count'])->get()->toArray();
        $citiesCountSum = array_sum($citiesCount);
        return [
            'cities' => \App\Models\City::all(),
            'cities_count' => $citiesCountSum,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список городов';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Общее кол-во запросов' => 'cities_count'
            ]),
            Layout::blank([CityTable::class]),

        ];
    }
}
