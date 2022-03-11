<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\CityTable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        return [
            'cities' => \App\Models\City::all(),
            'cities_sum_count' => DB::table('cities')->sum('count'),
            'cities_count' => \App\Models\City::all()->count(),
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
                'Кол-во городов' => 'cities_count',
                'Общее кол-во запросов' => 'cities_sum_count'
            ]),
            Layout::blank([CityTable::class]),

        ];
    }
}
