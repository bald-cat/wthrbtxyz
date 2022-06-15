<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\TelegramUsers;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class TelegramUser extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
           'users_count' => \App\Models\TelegramUser::query()->count(),
            'telegram_users' => \App\Models\TelegramUser::all()->sortByDesc('last_request_at'),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список пользователей';
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
               'Общее кол-во пользователей' => 'users_count'
           ]),

            Layout::blank([TelegramUsers::class]),

        ];
    }
}
