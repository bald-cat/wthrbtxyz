<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TelegramUsers extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'telegram_users';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('name', 'Имя пользователя')
                ->align('left'),
            TD::make('chat_id', 'id чата')->align('left'),
            TD::make('language_code', 'Язык приложения'),
            TD::make('created_at', 'Добавлен'),
            TD::make('last_request_at', 'Последний запрос'),
            TD::make('request_count', 'Кол-во запросов'),
        ];
    }
}
